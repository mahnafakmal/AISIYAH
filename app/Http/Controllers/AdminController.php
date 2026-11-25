<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\SalesReport;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $pendingOrders = Order::query()
            ->where('status', Order::AWAITING_APPROVAL)
            ->with(['user', 'items', 'paymentProofs' => fn ($query) => $query->latest()])
            ->latest()
            ->get();

        return view('dashboard.admin', [
            'user' => request()->user(),
            'products' => Product::query()->where('is_active', true)->orderBy('category')->orderBy('name')->get(),
            'staff' => request()->user()->role === 'admin'
                ? User::query()->whereIn('role', ['admin', 'pimpinan', 'pic'])->orderBy('role')->orderBy('name')->get()
                : collect(),
            'orders' => Order::query()->with(['user', 'items', 'paymentProofs' => fn ($query) => $query->latest()])
                ->whereIn('status', [Order::AWAITING_APPROVAL, Order::PAID])
                ->latest()
                ->limit(50)
                ->get(),
            'pendingOrders' => $pendingOrders,
            'reports' => SalesReport::query()->with('user')->latest()->limit(30)->get(),
            'summary' => [
                'sales' => Order::query()->where('status', Order::PAID)->sum('total_amount'),
                'pending' => $pendingOrders->count(),
                'products' => Product::query()->where('is_active', true)->count(),
                'pic' => User::query()->where('role', 'pic')->count(),
            ],
            'categories' => Product::CATEGORIES,
            'settings' => SiteSetting::query()->pluck('value', 'key'),
        ]);
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(Product::CATEGORIES))],
            'description' => ['required', 'string', 'max:3000'],
            'price' => ['required', 'integer', 'min:1', 'max:1000000000'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = $request->file('image')?->store('products', 'public');

        Product::create([
            'created_by' => $request->user()->id,
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'is_active' => true,
        ]);

        return back()->with('status', 'Produk berhasil ditambahkan ke katalog.');
    }

    public function deactivateProduct(Product $product): RedirectResponse
    {
        $product->update(['is_active' => false]);

        return back()->with('status', 'Produk disembunyikan dari katalog.');
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in(['admin', 'pimpinan', 'pic'])],
            'region' => ['nullable', 'string', 'max:120', 'required_if:role,pic'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'region' => $validated['role'] === 'pic' ? $validated['region'] : null,
            'password' => $validated['password'],
        ]);

        return back()->with('status', 'Akun staf berhasil dibuat.');
    }

    public function updateWelcome(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'welcome_message' => ['required', 'string', 'max:3000'],
            'tafsir_name' => ['required', 'string', 'max:120'],
            'eny_name' => ['required', 'string', 'max:120'],
            'tafsir_photo' => ['nullable', 'image', 'max:5120'],
            'eny_photo' => ['nullable', 'image', 'max:5120'],
        ]);

        foreach ([
            'welcome_message' => $validated['welcome_message'],
            'tafsir_name' => $validated['tafsir_name'],
            'eny_name' => $validated['eny_name'],
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        foreach (['tafsir_photo', 'eny_photo'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('welcome', 'public');
                SiteSetting::updateOrCreate(['key' => $field], ['value' => $path]);
            }
        }

        return back()->with('status', 'Sambutan halaman utama berhasil diperbarui.');
    }

    public function approvePayment(Order $order): RedirectResponse
    {
        DB::transaction(function () use ($order): void {
            $lockedOrder = Order::query()->lockForUpdate()->findOrFail($order->id);
            $proof = $lockedOrder->paymentProofs()
                ->where('status', 'pending')
                ->latest()
                ->lockForUpdate()
                ->first();

            if ($lockedOrder->status !== Order::AWAITING_APPROVAL || ! $proof) {
                throw ValidationException::withMessages([
                    'payment' => 'Tidak ada bukti pembayaran yang menunggu verifikasi untuk pesanan ini.',
                ]);
            }

            if ($lockedOrder->expires_at && $lockedOrder->expires_at->isPast()) {
                throw ValidationException::withMessages([
                    'payment' => 'Masa pemesanan sudah berakhir. Bukti pembayaran tidak dapat disetujui.',
                ]);
            }

            foreach ($lockedOrder->items as $item) {
                $inventory = Inventory::query()
                    ->where('product_id', $item->product_id)
                    ->where('region', $lockedOrder->region)
                    ->lockForUpdate()
                    ->first();

                if (! $inventory || $inventory->quantity < $item->quantity) {
                    throw ValidationException::withMessages([
                        'payment' => "Stok {$item->product_name} tidak mencukupi untuk menyetujui pesanan.",
                    ]);
                }

                $inventory->decrement('quantity', $item->quantity);
            }

            $proof->update([
                'status' => 'approved',
                'reviewed_by' => request()->user()->id,
                'reviewed_at' => now(),
            ]);
            $lockedOrder->update(['status' => Order::PAID]);
        });

        return back()->with('status', 'Pembayaran disetujui dan stok persediaan diperbarui.');
    }

    public function rejectPayment(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'review_note' => ['required', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($request, $order, $validated): void {
            $lockedOrder = Order::query()->lockForUpdate()->findOrFail($order->id);
            $proof = $lockedOrder->paymentProofs()
                ->where('status', 'pending')
                ->latest()
                ->lockForUpdate()
                ->first();

            if ($lockedOrder->status !== Order::AWAITING_APPROVAL || ! $proof) {
                throw ValidationException::withMessages([
                    'payment' => 'Tidak ada bukti pembayaran yang menunggu verifikasi untuk pesanan ini.',
                ]);
            }

            $proof->update([
                'status' => 'rejected',
                'reviewed_by' => $request->user()->id,
                'review_note' => $validated['review_note'],
                'reviewed_at' => now(),
            ]);
            $lockedOrder->update(['status' => Order::PAYMENT_REJECTED]);
        });

        return back()->with('status', 'Bukti pembayaran ditolak. Stok yang dipesan kembali tersedia.');
    }

    public function downloadSalesReport(SalesReport $salesReport): BinaryFileResponse
    {
        return response()->download(Storage::disk('local')->path($salesReport->file_path));
    }
}
