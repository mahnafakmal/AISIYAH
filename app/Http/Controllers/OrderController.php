<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    public function cart(): View
    {
        $cart = session('cart', []);
        $products = Product::query()
            ->whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->get()
            ->keyBy('id');
        $items = collect($cart)
            ->map(function (int $quantity, int|string $productId) use ($products): ?array {
                $product = $products->get($productId);

                if ($product === null) {
                    return null;
                }

                $discountPercent = $product->activeDiscountPercent();
                $unitPrice = $product->priceWithDiscount($discountPercent);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'discount_percent' => $discountPercent,
                    'line_total' => $unitPrice * $quantity,
                    'original_line_total' => $product->price * $quantity,
                ];
            })
            ->filter()
            ->values();

        return view('orders.cart', [
            'items' => $items,
            'total' => $items->sum('line_total'),
            'regions' => User::query()->where('role', 'pic')->whereNotNull('region')->distinct()->orderBy('region')->pluck('region'),
        ]);
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::query()->whereKey($validated['product_id'])->where('is_active', true)->firstOrFail();
        $cart = session('cart', []);
        $productId = (string) $product->id;
        $cart[$productId] = min(99, (int) ($cart[$productId] ?? 0) + $validated['quantity']);
        session(['cart' => $cart]);

        return back()->with('status', 'Produk ditambahkan ke keranjang.');
    }

    public function updateCartItem(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        abort_unless($product->is_active && array_key_exists((string) $product->id, session('cart', [])), 404);

        $cart = session('cart', []);
        $cart[(string) $product->id] = $validated['quantity'];
        session(['cart' => $cart]);

        return back()->with('status', 'Keranjang diperbarui.');
    }

    public function removeCartItem(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[(string) $product->id]);
        session(['cart' => $cart]);

        return back()->with('status', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'region' => [
                'required',
                'string',
                'max:255',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! User::query()->where('role', 'pic')->where('region', $value)->exists()) {
                        $fail('Pilih karesidenan yang memiliki PIC aktif.');
                    }
                },
            ],
        ]);
        $cart = collect(session('cart', []))
            ->map(fn ($quantity): int => (int) $quantity)
            ->filter(fn (int $quantity): bool => $quantity > 0 && $quantity <= 99)
            ->all();

        if ($cart === []) {
            throw ValidationException::withMessages([
                'cart' => 'Keranjang kosong. Tambahkan produk sebelum melanjutkan.',
            ]);
        }

        $order = DB::transaction(function () use ($cart, $validated, $request): Order {
            $products = Product::query()
                ->whereIn('id', array_keys($cart))
                ->where('is_active', true)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($products->count() !== count($cart)) {
                throw ValidationException::withMessages([
                    'cart' => 'Salah satu produk sudah tidak tersedia. Periksa kembali keranjang.',
                ]);
            }

            $orderItems = [];
            $totalAmount = 0;

            foreach ($cart as $productId => $quantity) {
                $product = $products->get($productId);
                $inventory = Inventory::query()
                    ->where('product_id', $product->id)
                    ->where('region', $validated['region'])
                    ->lockForUpdate()
                    ->first();

                if ($inventory === null || $inventory->quantity < $quantity) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok {$product->name} di karesidenan {$validated['region']} tidak mencukupi.",
                    ]);
                }

                $discountPercent = $product->activeDiscountPercent();
                $unitPrice = $product->priceWithDiscount($discountPercent);
                $inventory->decrement('quantity', $quantity);
                $lineTotal = $unitPrice * $quantity;
                $totalAmount += $lineTotal;
                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $unitPrice,
                    'original_unit_price' => $product->price,
                    'discount_percent' => $discountPercent,
                    'quantity' => $quantity,
                    'line_total' => $lineTotal,
                ];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'EAH-'.Str::upper(Str::random(12)),
                'region' => $validated['region'],
                'status' => Order::PENDING_PAYMENT,
                'total_amount' => $totalAmount,
            ]);

            foreach ($orderItems as $orderItem) {
                $order->items()->create($orderItem);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('status', 'Pesanan dibuat. Unggah bukti pembayaran untuk diproses.');
    }

    public function index(Request $request): View
    {
        return view('orders.index', [
            'orders' => Order::query()
                ->where('user_id', $request->user()->id)
                ->with('items')
                ->latest()
                ->get(),
        ]);
    }

    public function show(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 404);
        $order->load(['items', 'paymentProofs' => fn ($query) => $query->latest()]);

        return view('orders.show', ['order' => $order]);
    }

    public function uploadPaymentProof(Request $request, Order $order): RedirectResponse
    {
        abort_unless($order->user_id === $request->user()->id, 404);
        abort_unless($order->status === Order::PENDING_PAYMENT, 409, 'Pesanan ini tidak menerima bukti pembayaran lagi.');
        abort_if(
            $order->paymentProofs()->where('status', 'pending')->exists(),
            409,
            'Bukti pembayaran sedang menunggu verifikasi Admin.',
        );

        $validated = $request->validate([
            'proof' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
        ]);

        $path = $validated['proof']->store('payment-proofs', 'local');

        if (! is_string($path)) {
            throw new RuntimeException('Gagal menyimpan bukti pembayaran.');
        }

        $order->paymentProofs()->create([
            'uploaded_by' => $request->user()->id,
            'file_path' => $path,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Bukti pembayaran terkirim dan menunggu verifikasi Admin.');
    }

    public function downloadPaymentProof(Request $request, PaymentProof $paymentProof): StreamedResponse
    {
        $paymentProof->loadMissing('order');
        abort_unless($paymentProof->order->user_id === $request->user()->id, 404);

        return Storage::disk('local')->download(
            $paymentProof->file_path,
            'bukti-pembayaran-'.$paymentProof->order_id,
        );
    }
}
