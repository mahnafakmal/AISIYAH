<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_approved_payment_reduces_the_reserved_regional_stock(): void
    {
        Storage::fake('local');
        $customer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Yogyakarta']);
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Sabun lembut',
            'category' => 'kebersihan',
            'description' => 'Sabun untuk kebutuhan sehari-hari.',
            'price' => 25000,
            'is_active' => true,
        ]);
        $inventory = Inventory::create([
            'product_id' => $product->id,
            'region' => 'Yogyakarta',
            'quantity' => 5,
        ]);

        $createResponse = $this->actingAs($customer)->post(route('orders.store'), [
            'region' => 'Yogyakarta',
            'items' => [['product_id' => $product->id, 'quantity' => 2]],
        ]);

        $createResponse->assertRedirect();
        $order = Order::query()->firstOrFail();
        $this->assertSame(Order::PENDING_PAYMENT, $order->status);
        $this->assertSame(5, $inventory->fresh()->quantity);
        $this->assertSame(50000, $order->total_amount);

        $uploadResponse = $this->actingAs($customer)->post(route('orders.proof.store', $order), [
            'proof' => UploadedFile::fake()->image('proof.jpg'),
        ]);

        $uploadResponse->assertRedirect();
        $this->assertSame(Order::AWAITING_APPROVAL, $order->fresh()->status);
        $proof = PaymentProof::query()->firstOrFail();
        Storage::disk('local')->assertExists($proof->file_path);

        $approvalResponse = $this->actingAs($admin)->post(route('admin.orders.approve', $order));

        $approvalResponse->assertRedirect();
        $this->assertSame(Order::PAID, $order->fresh()->status);
        $this->assertSame(3, $inventory->fresh()->quantity);
        $this->assertDatabaseHas('payment_proofs', [
            'id' => $proof->id,
            'status' => 'approved',
            'reviewed_by' => $admin->id,
        ]);
    }

    public function test_customer_cannot_reserve_stock_already_held_by_another_order(): void
    {
        $firstCustomer = User::factory()->create(['role' => 'customer']);
        $secondCustomer = User::factory()->create(['role' => 'customer']);
        User::factory()->create(['role' => 'pic', 'region' => 'Solo']);
        $product = Product::create([
            'name' => 'Madu',
            'category' => 'makanan',
            'description' => 'Madu kemasan.',
            'price' => 40000,
            'is_active' => true,
        ]);
        Inventory::create([
            'product_id' => $product->id,
            'region' => 'Solo',
            'quantity' => 2,
        ]);

        $this->actingAs($firstCustomer)->post(route('orders.store'), [
            'region' => 'Solo',
            'items' => [['product_id' => $product->id, 'quantity' => 2]],
        ])->assertRedirect();

        $response = $this->actingAs($secondCustomer)->from(route('home'))->post(route('orders.store'), [
            'region' => 'Solo',
            'items' => [['product_id' => $product->id, 'quantity' => 1]],
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors('items');
        $this->assertSame(1, Order::query()->count());
    }

    public function test_customer_cannot_view_another_customers_payment_proof(): void
    {
        $owner = User::factory()->create(['role' => 'customer']);
        $otherCustomer = User::factory()->create(['role' => 'customer']);
        $order = Order::create([
            'user_id' => $owner->id,
            'order_number' => 'EA-PRIVATE01',
            'region' => 'Solo',
            'status' => Order::AWAITING_APPROVAL,
            'total_amount' => 10000,
            'expires_at' => now()->addDay(),
        ]);
        $proof = PaymentProof::create([
            'order_id' => $order->id,
            'uploaded_by' => $owner->id,
            'file_path' => 'payment-proofs/private.jpg',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($otherCustomer)->get(route('payment-proofs.show', $proof));

        $response->assertNotFound();
    }
}
