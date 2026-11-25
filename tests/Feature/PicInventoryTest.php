<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PicInventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_pic_updates_only_inventory_for_their_assigned_region(): void
    {
        $pic = User::factory()->create(['role' => 'pic', 'region' => 'Yogyakarta']);
        $product = Product::create([
            'name' => 'Pembersih rumah',
            'category' => 'kebersihan',
            'description' => 'Pembersih serbaguna.',
            'price' => 30000,
            'is_active' => true,
        ]);
        $otherRegionInventory = Inventory::create([
            'product_id' => $product->id,
            'region' => 'Solo',
            'quantity' => 8,
        ]);

        $response = $this->actingAs($pic)->put(route('pic.inventory.update'), [
            'product_id' => $product->id,
            'quantity' => 12,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('inventory', [
            'product_id' => $product->id,
            'region' => 'Yogyakarta',
            'quantity' => 12,
        ]);
        $this->assertSame(8, $otherRegionInventory->fresh()->quantity);
    }

    public function test_pimpinan_cannot_change_regional_inventory(): void
    {
        $pimpinan = User::factory()->create(['role' => 'pimpinan']);
        $product = Product::create([
            'name' => 'Pembersih',
            'category' => 'kebersihan',
            'description' => 'Pembersih.',
            'price' => 15000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($pimpinan)->put(route('pic.inventory.update'), [
            'product_id' => $product->id,
            'quantity' => 20,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('inventory', ['product_id' => $product->id]);
    }
}
