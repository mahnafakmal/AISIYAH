<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_always_creates_a_customer_account(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '08123456789',
            'password' => 'secure-password',
            'password_confirmation' => 'secure-password',
            'role' => 'admin',
            'region' => 'Jakarta',
        ]);

        $customer = User::query()->where('email', 'customer@example.com')->firstOrFail();

        $response->assertRedirect(route('storefront'));
        $this->assertAuthenticatedAs($customer);
        $this->assertSame('customer', $customer->role);
        $this->assertNull($customer->region);
    }

    public function test_login_redirects_a_regional_pic_to_their_dashboard(): void
    {
        $pic = User::factory()->create([
            'email' => 'pic@example.com',
            'password' => 'secure-password',
            'role' => 'pic',
            'region' => 'Kedu',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $pic->email,
            'password' => 'secure-password',
        ]);

        $response->assertRedirect(route('pic.dashboard'));
        $this->assertAuthenticatedAs($pic);
    }
}
