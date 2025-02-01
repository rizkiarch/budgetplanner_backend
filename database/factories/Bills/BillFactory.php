<?php

namespace Database\Factories\Bills;

use App\Models\Bills\Bill;
use App\Models\Bills\Enums\BillStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 100, 2000),
            'due_date' => Carbon::now()->addDays(rand(1, 30)),
            'status' => $this->faker->randomElement(BillStatus::cases()),
            'is_paid' => $this->faker->boolean(20)
        ];
    }
}
