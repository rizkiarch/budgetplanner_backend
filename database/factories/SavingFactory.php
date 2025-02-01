<?php

namespace Database\Factories;

use App\Models\Savings\Enums\SavingGoalType;
use App\Models\Savings\Saving;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SavingFactory extends Factory
{
    protected $model = Saving::class;
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
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'goal_amount' => function (array $attributes) {
                return $attributes['amount'] + $this->faker->numberBetween(1000, 10000);
            },
            'target_date' => Carbon::now()->addMonths(rand(3, 24)),
            'goal_type' => $this->faker->randomElement(SavingGoalType::cases())
        ];
    }
}
