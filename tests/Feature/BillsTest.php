<?php

namespace Tests\Feature;

use App\Models\Bills\Bill;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class BillsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    public function test_mark_bill_as_paid()
    {
        $bill = Bill::factory()->create([
            'user_id' => $this->user->id,
            'is_paid' => false
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson("/api/bills/{$bill->id}/mark-as-paid");

        $response->assertStatus(200)
            ->assertJson(['is_paid' => true]);
    }

    public function test_get_overdue_bills()
    {
        Bill::factory()->create([
            'user_id' => $this->user->id,
            'due_date' => Carbon::yesterday(),
            'status' => 'unpaid'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/bills/overdue');

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    // public function test_bill_update()
    // {
    //     $bill = Bill::factory()->create(['user_id' => $this->user->id]);

    //     $response = $this->withHeaders([
    //         'Authorization' => 'Bearer ' . $this->token,
    //     ])->putJson("/api/bills/{$bill->id}", [
    //         'name' => 'Updated Bill Name'
    //     ]);

    //     $response->assertStatus(200)
    //         ->assertJson(['name' => 'Updated Bill Name']);
    // }
}
