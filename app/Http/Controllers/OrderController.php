<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrderController extends Controller
{
    public function home(): View
    {
        $products = Product::query()
            ->where('is_active', true)
            ->with('inventory')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        $regions = User::query()
            ->where('role', 'pic')
            ->whereNotNull('region')
            ->distinct()
            ->orderBy('region')
            ->pluck('region');

        $pics = User::query()
            ->where('role', 'pic')
            ->whereNotNull('region')
            ->orderBy('region')
            ->orderBy('name')
            ->get(['name', 'region', 'phone']);

        $settings = SiteSetting::query()->pluck('value', 'key');

        $categories = Product::CATEGORIES;

        return view('welcome', compact('products', 'regions', 'pics', 'settings', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $regions = User::query()
            ->where('role', 'pic')
            ->whereNotNull('region')
            ->distinct()
            ->pluck('region')
            ->all();

        $validated = $request->validate([
            'region' => ['required', 'string', Rule::in($regions)],
            'items' => ['required', 'array', 'min:1', 'max:30'],
            'items.*.product_id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ], [
            'region.in' => 'Pilih Karesidenan yang tersedia.',
            'items.required' => 'Keranjang belanja masih kosong.',
        ]);

        $order = DB::transaction(function () use ($validated, $request): Order {
            $products = Product::query()
                ->whereIn('id', collect($validated['items'])->pluck('product_id'))
                ->where('is_active', true)
                ->get()
                ->keyBy('id');

            if ($products->count() !== count($validated['items'])) {
                throw ValidationException::withMessages([
                    'items' => 'Salah satu produk sudah tidak tersedia.',
                ]);
            }

            $orderLines = [];
            $total = 0;

            foreach ($validated['items'] as $item) {
                $product = $products->get((int) $item['product_id']);
                $inventory = Inventory::query()
                    ->where('product_id', $product->id)
                    ->where('region', $validated['region'])
                    ->lockForUpdate()
                    ->first();

                $reservedQuantity = OrderItem::query()
                    ->where('product_id', $product->id)
                    ->whereHas('order', function (Builder $query) use ($validated): void {
                        $query->where('region', $validated['region'])
                            ->whereIn('status', [Order::PENDING_PAYMENT, Order::AWAITING_APPROVAL])
                            ->where('expires_at', '>', now());
                    })
                    ->sum('quantity');

                $availableQuantity = max(0, ($inventory?->quantity ?? 0) - $reservedQuantity);

                if ($availableQuantity < (int) $item['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => "Stok {$product->name} di Karesidenan {$validated['region']} tidak mencukupi.",
                    ]);
                }

                $lineTotal = $product->price * (int) $item['quantity'];
                $total += $lineTotal;
                $orderLines[] = [
                    'product' => $product,
                    'quantity' => (int) $item['quantity'],
                    'line_total' => $lineTotal,
                ];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'EA-'.Str::upper(Str::random(10)),
                'region' => $validated['region'],
                'status' => Order::PENDING_PAYMENT,
                'total_amount' => $total,
                'expires_at' => now()->addDay(),
            ]);

            foreach ($orderLines as $line) {
                $order->items()->create([
                    'product_id' => $line['product']->id,
                    'product_name' => $line['product']->name,
                    'unit_price' => $line['product']->price,
                    'quantity' => $line['quantity'],
                    'line_total' => $line['line_total'],
                ]);
            }

            return $order;
        });

        return redirect()->route('orders.show', $order)
            ->with('status', 'Pesanan dibuat. Unggah bukti transfer agar dapat diverifikasi Admin.');
    }

    public function show(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        $order->load(['items', 'paymentProofs' => fn ($query) => $query->latest()]);

        return view('orders.show', compact('order'));
    }

    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->with(['items', 'paymentProofs' => fn ($query) => $query->latest()])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function uploadPaymentProof(Request $request, Order $order): RedirectResponse
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        $request->validate([
            'proof' => ['required', 'image', 'max:10240'],
        ], [
            'proof.image' => 'Bukti pembayaran harus berupa gambar yang valid.',
            'proof.max' => 'Ukuran bukti pembayaran maksimal 10 MB.',
        ]);

        if (! in_array($order->status, [Order::PENDING_PAYMENT, Order::PAYMENT_REJECTED], true)
            || ($order->expires_at && $order->expires_at->isPast())) {
            throw ValidationException::withMessages([
                'proof' => 'Pesanan ini tidak lagi menerima bukti pembayaran.',
            ]);
        }

        $latestProof = $order->paymentProofs()->latest()->first();

        if ($latestProof?->status === 'pending') {
            throw ValidationException::withMessages([
                'proof' => 'Bukti pembayaran sedang menunggu verifikasi Admin.',
            ]);
        }

        $path = $request->file('proof')->store('payment-proofs');

        $order->paymentProofs()->create([
            'uploaded_by' => $request->user()->id,
            'file_path' => $path,
            'status' => 'pending',
        ]);
        $order->update(['status' => Order::AWAITING_APPROVAL]);

        return back()->with('status', 'Bukti pembayaran terkirim dan menunggu verifikasi.');
    }

    public function showPaymentProof(Request $request, PaymentProof $paymentProof): BinaryFileResponse
    {
        if ($request->user()->role === 'customer'
            && (int) $paymentProof->order()->value('user_id') !== $request->user()->id) {
            abort(404);
        }

        return response()->file(Storage::disk('local')->path($paymentProof->file_path));
    }
}
