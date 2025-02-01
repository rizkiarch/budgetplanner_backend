<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // public function test_user_registration()
    // {
    //     $response = $this->postJson('/api/register', [
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password'
    //     ]);

    //     $response->assertStatus(201)
    //         ->assertJsonStructure(['token']);
    // }

    // public function test_user_login()
    // {
    //     $user = User::factory()->create([
    //         'password' => bcrypt('password')
    //     ]);

    //     $this->actingAs($user, 'sanctum');

    //     $response = $this->postJson('/api/login', [
    //         'email' => 'test@example.com',
    //         'password' => 'password'
    //     ]);

    //     $response->assertStatus(200)
    //         ->assertJsonStructure(['token']);
    // }

    public function test_protected_routes()
    {
        $response = $this->getJson('/api/incomes');
        $response->assertStatus(401);
    }
}
