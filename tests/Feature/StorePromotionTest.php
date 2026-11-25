<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorePromotionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_the_promo_banner_and_marketplace_links(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->put(route('admin.promo-settings.update'), [
                'promo_banner_enabled' => '1',
                'promo_badge_title' => 'PROMO GEBYAR',
                'promo_offer_text' => 'Diskon spesial untuk produk pilihan!',
                'promo_voucher_code' => 'AISYIYAH20',
                'promo_valid_until' => 'Berlaku s/d 31 Des 2026',
            ])
            ->assertRedirect(route('admin.dashboard'));

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->put(route('admin.marketplace-settings.update'), [
                'shopee_url' => 'https://shopee.co.id/aisyiyah',
                'tokopedia_url' => 'https://www.tokopedia.com/aisyiyah',
                'tiktok_url' => 'https://www.tiktok.com/@aisyiyah',
            ])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('site_settings', [
            'key' => 'promo_badge_title',
            'value' => 'PROMO GEBYAR',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'marketplace_shopee_url',
            'value' => 'https://shopee.co.id/aisyiyah',
        ]);

        $this->get(route('storefront'))
            ->assertOk()
            ->assertSeeText('PROMO GEBYAR')
            ->assertSeeText('Diskon spesial untuk produk pilihan!')
            ->assertSeeText('AISYIYAH20')
            ->assertSeeText('Berlaku s/d 31 Des 2026')
            ->assertSeeText('Shopee')
            ->assertSee('href="https://shopee.co.id/aisyiyah"', false);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSeeText('Banner Pengumuman Promo Toko')
            ->assertSeeText('Diskon Persentase Massal')
            ->assertSeeText('Tautan Toko Marketplace Utama (Default Global)');

        $this->actingAs($admin)
            ->put(route('admin.promo-settings.update'), [
                'promo_banner_enabled' => '0',
                'promo_badge_title' => 'PROMO GEBYAR',
                'promo_offer_text' => 'Diskon spesial untuk produk pilihan!',
                'promo_voucher_code' => 'AISYIYAH20',
                'promo_valid_until' => 'Berlaku s/d 31 Des 2026',
            ])
            ->assertRedirect();

        $this->get(route('storefront'))
            ->assertOk()
            ->assertDontSeeText('PROMO GEBYAR')
            ->assertDontSeeText('AISYIYAH20');
    }

    public function test_admin_can_apply_a_mass_discount_to_one_category_only(): void
    {
        $this->freezeTime();
        $admin = User::factory()->create(['role' => 'admin']);
        $skincare = Product::create([
            'name' => 'Pelembap',
            'category' => 'skincare',
            'description' => 'Produk skincare',
            'price' => 20000,
            'is_active' => true,
        ]);
        $food = Product::create([
            'name' => 'Roti',
            'category' => 'makanan',
            'description' => 'Produk makanan',
            'price' => 10000,
            'is_active' => true,
        ]);
        $archived = Product::create([
            'name' => 'Produk Arsip',
            'category' => 'skincare',
            'description' => 'Produk nonaktif',
            'price' => 15000,
            'is_active' => false,
        ]);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->post(route('admin.promotions.apply'), [
                'target_category' => 'skincare',
                'discount_percent' => 15,
            ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHas('status', 'Diskon 15% diterapkan ke 1 produk aktif.');

        $this->assertDatabaseHas('products', ['id' => $skincare->id, 'discount_percent' => 15]);
        $this->assertDatabaseHas('products', ['id' => $food->id, 'discount_percent' => null]);
        $this->assertDatabaseHas('products', ['id' => $archived->id, 'discount_percent' => null]);

        $this->get(route('storefront'))
            ->assertOk()
            ->assertSeeText('Pelembap')
            ->assertSeeText('Rp 17.000')
            ->assertSeeText('Rp 20.000')
            ->assertSeeText('Roti')
            ->assertSeeText('Rp 10.000');

        User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        Inventory::create([
            'product_id' => $skincare->id,
            'region' => 'Kedu',
            'quantity' => 2,
        ]);
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)
            ->withSession(['cart' => [(string) $skincare->id => 1]])
            ->post(route('orders.store'), ['region' => 'Kedu'])
            ->assertRedirect();

        $order = Order::query()->firstOrFail();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'total_amount' => 17000,
        ]);
    }

    public function test_admin_can_apply_a_mass_discount_to_all_active_categories(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $skincare = Product::create([
            'name' => 'Pelembap',
            'category' => 'skincare',
            'description' => 'Produk skincare',
            'price' => 20000,
            'is_active' => true,
        ]);
        $food = Product::create([
            'name' => 'Roti',
            'category' => 'makanan',
            'description' => 'Produk makanan',
            'price' => 10000,
            'is_active' => true,
        ]);
        $archived = Product::create([
            'name' => 'Produk Arsip',
            'category' => 'kebersihan',
            'description' => 'Produk nonaktif',
            'price' => 15000,
            'is_active' => false,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.promotions.apply'), [
                'target_category' => 'all',
                'discount_percent' => 20,
            ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Diskon 20% diterapkan ke 2 produk aktif.');

        $this->assertDatabaseHas('products', ['id' => $skincare->id, 'discount_percent' => 20]);
        $this->assertDatabaseHas('products', ['id' => $food->id, 'discount_percent' => 20]);
        $this->assertDatabaseHas('products', ['id' => $archived->id, 'discount_percent' => null]);
    }

    public function test_reset_promotion_restores_normal_prices_for_all_products(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $activeProduct = Product::create([
            'name' => 'Produk Aktif',
            'category' => 'skincare',
            'description' => 'Produk aktif promo',
            'price' => 20000,
            'discount_percent' => 20,
            'discount_starts_at' => now()->subHour(),
            'discount_ends_at' => now()->addHour(),
            'is_active' => true,
        ]);
        $archivedProduct = Product::create([
            'name' => 'Produk Arsip',
            'category' => 'makanan',
            'description' => 'Produk arsip promo',
            'price' => 10000,
            'discount_percent' => 10,
            'discount_starts_at' => now()->subHour(),
            'is_active' => false,
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.promotions.reset'))
            ->assertRedirect()
            ->assertSessionHas('status', 'Promo dihapus dan harga normal dipulihkan untuk 2 produk.');

        foreach ([$activeProduct, $archivedProduct] as $product) {
            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'discount_percent' => null,
                'discount_starts_at' => null,
                'discount_ends_at' => null,
            ]);
        }
    }

    public function test_mass_discount_rejects_an_invalid_percentage_or_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Produk',
            'category' => 'makanan',
            'description' => 'Produk lokal',
            'price' => 5000,
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->post(route('admin.promotions.apply'), [
                'target_category' => 'tidak-ada',
                'discount_percent' => 91,
            ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHasErrors(['target_category', 'discount_percent']);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'discount_percent' => null,
        ]);
    }

    public function test_marketplace_links_reject_non_http_schemes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->put(route('admin.marketplace-settings.update'), [
                'shopee_url' => 'javascript:alert(1)',
            ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHasErrors('shopee_url');

        $this->assertDatabaseMissing('site_settings', ['key' => 'marketplace_shopee_url']);
    }

    public function test_customer_cannot_apply_mass_promotions(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = Product::create([
            'name' => 'Produk',
            'category' => 'makanan',
            'description' => 'Produk lokal',
            'price' => 5000,
            'is_active' => true,
        ]);

        $this->actingAs($customer)
            ->post(route('admin.promotions.apply'), [
                'target_category' => 'all',
                'discount_percent' => 10,
            ])
            ->assertForbidden();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'discount_percent' => null,
        ]);
    }

    public function test_checkout_applies_active_promotion_and_snapshots_both_prices(): void
    {
        $this->freezeTime();
        $customer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        $product = Product::create([
            'name' => 'Sabun Promo',
            'category' => 'kebersihan',
            'description' => 'Sabun produk lokal',
            'price' => 10000,
            'discount_percent' => 20,
            'discount_starts_at' => now()->subHour(),
            'discount_ends_at' => now()->addHour(),
            'is_active' => true,
        ]);
        Inventory::create([
            'product_id' => $product->id,
            'region' => 'Kedu',
            'quantity' => 5,
        ]);

        $response = $this->actingAs($customer)
            ->withSession(['cart' => [(string) $product->id => 2]])
            ->post(route('orders.store'), ['region' => 'Kedu']);

        $order = Order::query()->firstOrFail();
        $response->assertRedirect(route('orders.show', $order));
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'total_amount' => 16000]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'unit_price' => 8000,
            'original_unit_price' => 10000,
            'discount_percent' => 20,
            'quantity' => 2,
            'line_total' => 16000,
        ]);
    }

    public function test_cart_shows_the_active_promotional_price(): void
    {
        $this->freezeTime();
        $customer = User::factory()->create(['role' => 'customer']);
        $product = Product::create([
            'name' => 'Pelembap Promo',
            'category' => 'skincare',
            'description' => 'Pelembap produk lokal',
            'price' => 10000,
            'discount_percent' => 20,
            'discount_starts_at' => now()->subHour(),
            'discount_ends_at' => now()->addHour(),
            'is_active' => true,
        ]);

        $this->actingAs($customer)
            ->withSession(['cart' => [(string) $product->id => 2]])
            ->get(route('cart.index'))
            ->assertOk()
            ->assertSeeText('Harga promo Rp 8.000 per item')
            ->assertSeeText('Rp 16.000');
    }

    public function test_checkout_uses_regular_price_when_promotion_is_not_active(): void
    {
        $this->freezeTime();
        $customer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        $product = Product::create([
            'name' => 'Produk Promo Terjadwal',
            'category' => 'kebersihan',
            'description' => 'Pembersih rumah',
            'price' => 10000,
            'discount_percent' => 20,
            'discount_starts_at' => now()->addDay(),
            'discount_ends_at' => now()->addDays(2),
            'is_active' => true,
        ]);
        Inventory::create([
            'product_id' => $product->id,
            'region' => 'Kedu',
            'quantity' => 2,
        ]);

        $this->actingAs($customer)
            ->withSession(['cart' => [(string) $product->id => 1]])
            ->post(route('orders.store'), ['region' => 'Kedu'])
            ->assertRedirect();

        $order = Order::query()->firstOrFail();
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'total_amount' => 10000]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'unit_price' => 10000,
            'original_unit_price' => 10000,
            'discount_percent' => null,
            'line_total' => 10000,
        ]);
    }
}
