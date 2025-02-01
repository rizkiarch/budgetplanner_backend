<?php

namespace Database\Factories;

use App\Models\Expenses\Enums\ExpenseCategory;
use App\Models\Expenses\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'category' => $this->faker->randomElement(ExpenseCategory::cases()),
            'is_recurring' => $this->faker->boolean(30)
        ];
    }
}
