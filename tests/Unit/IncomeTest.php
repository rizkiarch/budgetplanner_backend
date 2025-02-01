<?php

// namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

// class IncomeTest extends TestCase
// {
//     public function test_can_create_income_source()
//     {
//         $user = User::factory()->create();
//         $token = $user->createToken('test-token')->plainTextToken;

//         $response = $this->withHeaders([
//             'Authorization' => 'Bearer ' . $token,
//         ])->postJson('/api/income-sources', [
//             'name' => 'Salary',
//             'amount' => 5000,
//             'date' => '2024-03-01',
//             'category' => 'salary'
//         ]);

//         $response->assertStatus(201);
//         $this->assertDatabaseHas('income_sources', ['name' => 'Salary']);
//     }
// }
