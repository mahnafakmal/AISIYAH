<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');
        $activeProducts = Product::query()
            ->where('is_active', true)
            ->withSum('inventories', 'quantity')
            ->orderBy('name')
            ->get();

        return view('storefront', [
            'categories' => Product::CATEGORIES,
            'productsByCategory' => $activeProducts->groupBy('category'),
            'promoProducts' => $activeProducts
                ->filter(fn (Product $product): bool => $product->isPromoActive())
                ->values(),
            'promoBanner' => [
                'enabled' => ($settings['promo_banner_enabled'] ?? '0') === '1',
                'badgeTitle' => $settings['promo_badge_title'] ?? null,
                'offerText' => $settings['promo_offer_text'] ?? null,
                'voucherCode' => $settings['promo_voucher_code'] ?? null,
                'validUntil' => $settings['promo_valid_until'] ?? null,
            ],
            'marketplaceLinks' => collect([
                ['name' => 'Shopee', 'url' => $settings['marketplace_shopee_url'] ?? null],
                ['name' => 'Tokopedia', 'url' => $settings['marketplace_tokopedia_url'] ?? null],
                ['name' => 'TikTok Shop', 'url' => $settings['marketplace_tiktok_url'] ?? null],
            ])->filter(fn (array $link): bool => is_string($link['url']) && $link['url'] !== '')->values(),
            'picUsers' => User::query()
                ->where('role', 'pic')
                ->whereNotNull('region')
                ->orderBy('region')
                ->orderBy('name')
                ->get(['id', 'name', 'region', 'phone']),
            'welcomeMessage' => $settings['welcome_message']
                ?? 'Selamat datang di PT Ekonomi Aisyiyah Hasanah Makmur. Mari berkolaborasi memberdayakan produk lokal, memperkuat UMKM, dan menumbuhkan kemandirian ekonomi umat.',
            'tafsirPhoto' => $this->publicImage($settings['tafsir_photo'] ?? null),
            'enyPhoto' => $this->publicImage($settings['eny_photo'] ?? null),
        ]);
    }

    private function publicImage(?string $path): ?string
    {
        return $path === null ? null : Storage::disk('public')->url($path);
    }
}
