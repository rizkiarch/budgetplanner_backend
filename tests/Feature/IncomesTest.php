<?php

namespace Tests\Feature;

use App\Models\Incomes\Income;
use App\Models\User;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    public function test_can_create_income()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/incomes', [
            'name' => 'Salary',
            'amount' => 5000,
            'date' => '2024-03-01',
            'category' => 'salary'
        ]);

        $response->assertStatus(201)
            ->assertJson(['name' => 'Salary']);
    }

    public function test_validation_for_income_creation()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/incomes', [
            'name' => '',
            'amount' => 'invalid',
            'date' => 'invalid-date'
        ]);

        $response->assertStatus(422);
    }

    public function test_can_retrieve_incomes()
    {
        Income::factory(3)->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/incomes');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_cannot_access_other_users_incomes()
    {
        $otherUser = User::factory()->create();
        Income::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/incomes');

        $response->assertJsonCount(0);
    }
}
