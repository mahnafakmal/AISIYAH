<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\SalesReport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_lists_the_required_product_categories_and_regional_contacts(): void
    {
        User::factory()->create([
            'role' => 'pic',
            'region' => 'Kedu',
            'name' => 'PIC Kedu',
        ]);

        $this->get(route('storefront'))
            ->assertOk()
            ->assertSee('Skincare')
            ->assertSee('Makanan')
            ->assertSee('Kebersihan')
            ->assertSee('Bapak Tafsir')
            ->assertSee('Ibu Eny')
            ->assertSee('PIC Kedu');
    }

    public function test_customer_checkout_deducts_stock_and_snapshots_the_order_total(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        $product = Product::create([
            'name' => 'Sabun UMKM',
            'category' => 'kebersihan',
            'description' => 'Produk kebersihan lokal',
            'price' => 15000,
            'is_active' => true,
        ]);
        $inventory = Inventory::create([
            'product_id' => $product->id,
            'region' => 'Kedu',
            'quantity' => 5,
        ]);

        $response = $this->actingAs($customer)
            ->withSession(['cart' => [(string) $product->id => 2]])
            ->post(route('orders.store'), ['region' => 'Kedu']);

        $order = Order::query()->firstOrFail();
        $response->assertRedirect(route('orders.show', $order));
        $response->assertSessionMissing('cart');
        $this->assertDatabaseHas('inventory', ['id' => $inventory->id, 'quantity' => 3]);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => Order::PENDING_PAYMENT,
            'total_amount' => 30000,
        ]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_name' => 'Sabun UMKM',
            'unit_price' => 15000,
            'quantity' => 2,
            'line_total' => 30000,
        ]);
    }

    public function test_checkout_rejects_insufficient_stock_without_changing_inventory(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        $product = Product::create([
            'name' => 'Pembersih',
            'category' => 'kebersihan',
            'description' => 'Pembersih rumah',
            'price' => 10000,
            'is_active' => true,
        ]);
        Inventory::create(['product_id' => $product->id, 'region' => 'Kedu', 'quantity' => 1]);

        $this->actingAs($customer)
            ->withSession(['cart' => [(string) $product->id => 2]])
            ->from(route('cart.index'))
            ->post(route('orders.store'), ['region' => 'Kedu'])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHasErrors('cart');

        $this->assertDatabaseHas('inventory', ['product_id' => $product->id, 'region' => 'Kedu', 'quantity' => 1]);
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_pic_cannot_open_admin_dashboard(): void
    {
        $pic = User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);

        $this->actingAs($pic)->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_customer_cannot_download_another_customers_payment_proof(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $otherCustomer = User::factory()->create(['role' => 'customer']);
        $order = $this->createOrder($otherCustomer);
        $proof = PaymentProof::create([
            'order_id' => $order->id,
            'uploaded_by' => $otherCustomer->id,
            'file_path' => 'payment-proofs/private.pdf',
            'status' => 'pending',
        ]);

        $this->actingAs($customer)
            ->get(route('orders.payment-proofs.download', $proof))
            ->assertNotFound();
    }

    public function test_pic_csv_stock_upload_is_limited_to_their_region(): void
    {
        $pic = User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);
        $product = Product::create([
            'name' => 'Pembersih UMKM',
            'category' => 'kebersihan',
            'description' => 'Produk pembersih',
            'price' => 12000,
            'is_active' => true,
        ]);
        Inventory::create(['product_id' => $product->id, 'region' => 'Solo', 'quantity' => 20]);

        $this->actingAs($pic)
            ->post(route('pic.inventory.upload'), [
                'inventory_file' => UploadedFile::fake()->createWithContent(
                    'stok.csv',
                    "product_id,quantity\n{$product->id},13\n",
                ),
            ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Stok dari CSV berhasil diimpor.');

        $this->assertDatabaseHas('inventory', ['product_id' => $product->id, 'region' => 'Kedu', 'quantity' => 13]);
        $this->assertDatabaseHas('inventory', ['product_id' => $product->id, 'region' => 'Solo', 'quantity' => 20]);
    }

    public function test_pic_can_upload_a_private_sales_report_for_their_region(): void
    {
        Storage::fake('local');
        $pic = User::factory()->create(['role' => 'pic', 'region' => 'Kedu']);

        $this->actingAs($pic)
            ->post(route('pic.sales-reports.store'), [
                'period' => '2026-11',
                'remarks' => 'Rekap bulanan',
                'report_file' => UploadedFile::fake()->createWithContent('rekap.pdf', '%PDF-1.4 sales report'),
            ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Rekap penjualan berhasil diunggah.');

        $report = SalesReport::query()->firstOrFail();
        $this->assertSame('Kedu', $report->region);
        $this->assertSame($pic->id, $report->user_id);
        Storage::disk('local')->assertExists($report->file_path);
    }

    public function test_admin_cancellation_returns_reserved_stock_to_the_order_region(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Sabun',
            'category' => 'kebersihan',
            'description' => 'Sabun lokal',
            'price' => 5000,
            'is_active' => true,
        ]);
        $inventory = Inventory::create(['product_id' => $product->id, 'region' => 'Kedu', 'quantity' => 3]);
        $order = $this->createOrder($customer);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => 2,
            'line_total' => 10000,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.orders.cancel', $order))
            ->assertRedirect();

        $this->assertDatabaseHas('inventory', ['id' => $inventory->id, 'quantity' => 5]);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'cancelled']);
    }

    public function test_customer_can_upload_payment_proof_and_admin_approval_records_the_sale(): void
    {
        Storage::fake('local');
        $customer = User::factory()->create(['role' => 'customer']);
        $admin = User::factory()->create(['role' => 'admin']);
        $order = $this->createOrder($customer);

        $this->actingAs($customer)
            ->post(route('orders.payment-proofs.store', $order), [
                'proof' => UploadedFile::fake()->createWithContent('receipt.pdf', '%PDF-1.4 payment receipt'),
            ])
            ->assertRedirect();

        $proof = PaymentProof::query()->firstOrFail();
        $this->assertSame('pending', $proof->status);
        Storage::disk('local')->assertExists($proof->file_path);

        $this->actingAs($admin)
            ->post(route('admin.payment-proofs.approve', $proof))
            ->assertRedirect();

        $this->assertDatabaseHas('payment_proofs', ['id' => $proof->id, 'status' => 'approved', 'reviewed_by' => $admin->id]);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => Order::PAID]);
    }

    private function createOrder(User $customer): Order
    {
        return Order::create([
            'user_id' => $customer->id,
            'order_number' => 'EAH-TEST-'.$customer->id,
            'region' => 'Kedu',
            'status' => Order::PENDING_PAYMENT,
            'total_amount' => 25000,
        ]);
    }
}
