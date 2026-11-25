<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_a_customer_even_if_a_role_is_submitted(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Pelanggan Baru',
            'email' => 'buyer@example.test',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'buyer@example.test',
            'role' => 'customer',
        ]);
        $this->assertSame('customer', User::query()->where('email', 'buyer@example.test')->value('role'));
    }
}
