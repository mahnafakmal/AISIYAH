<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\SalesReport;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->withSum('inventories', 'quantity')->latest()->get();

        return view('dashboard.admin', [
            'products' => $products,
            'activeProductsCount' => $products->where('is_active', true)->count(),
            'promoProductsCount' => $products->filter(fn (Product $product): bool => $product->discount_percent !== null)->count(),
            'staffUsers' => User::query()->whereIn('role', ['admin', 'pimpinan', 'pic'])->orderBy('role')->orderBy('name')->get(),
            'orders' => Order::query()->with(['user', 'items', 'paymentProofs.uploader'])->latest()->limit(50)->get(),
            'pendingProofs' => PaymentProof::query()
                ->where('status', 'pending')
                ->with(['order.user', 'uploader'])
                ->latest()
                ->get(),
            'salesReports' => SalesReport::query()->with('user')->latest()->limit(20)->get(),
            'siteSettings' => SiteSetting::query()->pluck('value', 'key'),
        ]);
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(Product::CATEGORIES))],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'integer', 'min:1', 'max:1000000000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $product = Product::create([
            ...collect($validated)->except('image')->all(),
            'created_by' => $request->user()->id,
            'is_active' => true,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('product-images', 'public');

            if (! is_string($path)) {
                throw new RuntimeException('Gagal menyimpan foto produk.');
            }

            $product->update(['image_path' => $path]);
        }

        return back()->with('status', 'Produk berhasil ditambahkan.');
    }

    public function updateProduct(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(Product::CATEGORIES))],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'integer', 'min:1', 'max:1000000000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $product->update(collect($validated)->except('image')->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('product-images', 'public');

            if (! is_string($path)) {
                throw new RuntimeException('Gagal menyimpan foto produk.');
            }

            if ($product->image_path !== null) {
                Storage::disk('public')->delete($product->image_path);
            }

            $product->update(['image_path' => $path]);
        }

        return back()->with('status', 'Produk berhasil diperbarui.');
    }

    public function updatePromotionSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'promo_banner_enabled' => ['nullable', 'boolean'],
            'promo_badge_title' => ['required', 'string', 'max:100'],
            'promo_offer_text' => ['required', 'string', 'max:500'],
            'promo_voucher_code' => ['nullable', 'string', 'max:50'],
            'promo_valid_until' => ['nullable', 'string', 'max:100'],
        ]);

        $this->saveSiteSettings([
            'promo_banner_enabled' => $request->boolean('promo_banner_enabled') ? '1' : '0',
            'promo_badge_title' => $validated['promo_badge_title'],
            'promo_offer_text' => $validated['promo_offer_text'],
            'promo_voucher_code' => $validated['promo_voucher_code'] ?? null,
            'promo_valid_until' => $validated['promo_valid_until'] ?? null,
        ]);

        return back()->with('status', 'Pengaturan banner promo berhasil disimpan.');
    }

    public function updateMarketplaceSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'shopee_url' => ['nullable', 'url:http,https', 'max:2048'],
            'tokopedia_url' => ['nullable', 'url:http,https', 'max:2048'],
            'tiktok_url' => ['nullable', 'url:http,https', 'max:2048'],
        ]);

        $this->saveSiteSettings([
            'marketplace_shopee_url' => $validated['shopee_url'] ?? null,
            'marketplace_tokopedia_url' => $validated['tokopedia_url'] ?? null,
            'marketplace_tiktok_url' => $validated['tiktok_url'] ?? null,
        ]);

        return back()->with('status', 'Tautan marketplace berhasil disimpan.');
    }

    public function applyMassPromotion(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'target_category' => ['required', Rule::in(['all', ...array_keys(Product::CATEGORIES)])],
            'discount_percent' => ['required', 'integer', 'between:1,90'],
        ]);

        $updatedCount = DB::transaction(function () use ($validated): int {
            $products = Product::query()->where('is_active', true);

            if ($validated['target_category'] !== 'all') {
                $products->where('category', $validated['target_category']);
            }

            return $products->update([
                'discount_percent' => $validated['discount_percent'],
                'discount_starts_at' => now(),
                'discount_ends_at' => null,
            ]);
        });

        return back()->with(
            'status',
            "Diskon {$validated['discount_percent']}% diterapkan ke {$updatedCount} produk aktif.",
        );
    }

    public function resetMassPromotions(): RedirectResponse
    {
        $resetCount = DB::transaction(fn (): int => Product::query()
            ->whereNotNull('discount_percent')
            ->update([
                'discount_percent' => null,
                'discount_starts_at' => null,
                'discount_ends_at' => null,
            ]));

        return back()->with('status', "Promo dihapus dan harga normal dipulihkan untuk {$resetCount} produk.");
    }

    /**
     * @param  array<string, string|null>  $settings
     */
    private function saveSiteSettings(array $settings): void
    {
        DB::transaction(function () use ($settings): void {
            foreach ($settings as $key => $value) {
                SiteSetting::query()->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value],
                );
            }
        });
    }

    public function archiveProduct(Product $product): RedirectResponse
    {
        $product->update(['is_active' => false]);

        return back()->with('status', 'Produk dinonaktifkan dan tidak lagi tampil di katalog.');
    }

    public function storeStaff(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in(['admin', 'pimpinan', 'pic'])],
            'region' => ['required_if:role,pic', 'nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($validated);

        return back()->with('status', 'Akun staf berhasil dibuat.');
    }

    public function updateSiteSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'welcome_message' => ['required', 'string', 'max:3000'],
            'tafsir_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'eny_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'welcome_message'],
            ['value' => $validated['welcome_message']],
        );

        foreach (['tafsir_photo', 'eny_photo'] as $field) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $path = $request->file($field)->storePublicly('leadership', 'public');

            if (! is_string($path)) {
                throw new RuntimeException('Gagal menyimpan foto sambutan.');
            }

            $setting = SiteSetting::query()->firstOrNew(['key' => $field]);
            $oldPath = $setting->value;
            $setting->value = $path;
            $setting->save();

            if (is_string($oldPath) && $oldPath !== $path) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        return back()->with('status', 'Sambutan berhasil diperbarui.');
    }

    public function approvePayment(PaymentProof $paymentProof): RedirectResponse
    {
        DB::transaction(function () use ($paymentProof): void {
            $proof = PaymentProof::query()->lockForUpdate()->findOrFail($paymentProof->id);
            $order = Order::query()->lockForUpdate()->findOrFail($proof->order_id);

            abort_unless(
                $proof->status === 'pending' && $order->status === Order::PENDING_PAYMENT,
                409,
                'Bukti pembayaran ini sudah ditinjau.',
            );

            $proof->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            $order->update(['status' => Order::PAID]);
        });

        return back()->with('status', 'Pembayaran disetujui. Rekap penjualan diperbarui.');
    }

    public function rejectPayment(Request $request, PaymentProof $paymentProof): RedirectResponse
    {
        $validated = $request->validate([
            'review_note' => ['required', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($paymentProof, $request, $validated): void {
            $proof = PaymentProof::query()->lockForUpdate()->findOrFail($paymentProof->id);
            $order = Order::query()->lockForUpdate()->findOrFail($proof->order_id);

            abort_unless($proof->status === 'pending' && $order->status === Order::PENDING_PAYMENT, 409, 'Bukti pembayaran ini sudah ditinjau.');

            $proof->update([
                'status' => 'rejected',
                'review_note' => $validated['review_note'],
                'reviewed_by' => $request->user()->id,
                'reviewed_at' => now(),
            ]);
        });

        return back()->with('status', 'Bukti pembayaran ditolak. Pelanggan dapat mengunggah bukti baru.');
    }

    public function cancelOrder(Order $order): RedirectResponse
    {
        DB::transaction(function () use ($order): void {
            $lockedOrder = Order::query()->with('items')->lockForUpdate()->findOrFail($order->id);

            abort_unless($lockedOrder->status === Order::PENDING_PAYMENT, 409, 'Hanya pesanan yang menunggu pembayaran yang dapat dibatalkan.');

            foreach ($lockedOrder->items as $item) {
                $inventory = Inventory::query()
                    ->where('product_id', $item->product_id)
                    ->where('region', $lockedOrder->region)
                    ->lockForUpdate()
                    ->first();

                if ($inventory === null) {
                    Inventory::create([
                        'product_id' => $item->product_id,
                        'region' => $lockedOrder->region,
                        'quantity' => $item->quantity,
                    ]);
                } else {
                    $inventory->increment('quantity', $item->quantity);
                }
            }

            $lockedOrder->update(['status' => 'cancelled']);
        });

        return back()->with('status', 'Pesanan dibatalkan dan stok wilayah dikembalikan.');
    }

    public function downloadPaymentProof(PaymentProof $paymentProof): StreamedResponse
    {
        return Storage::disk('local')->download(
            $paymentProof->file_path,
            'bukti-pembayaran-'.$paymentProof->order_id,
        );
    }

    public function downloadSalesReport(SalesReport $salesReport): StreamedResponse
    {
        return Storage::disk('local')->download(
            $salesReport->file_path,
            'rekap-penjualan-'.$salesReport->period,
        );
    }
}
