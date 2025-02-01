<?php

namespace Database\Factories;

use App\Models\Incomes\Enums\IncomeCategory;
use App\Models\Incomes\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    protected $model = Income::class;

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
            'amount' => $this->faker->randomFloat(2, 1000, 10000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'category' => $this->faker->randomElement(IncomeCategory::cases()),
            'description' => $this->faker->sentence
        ];
    }
}
