<?php

namespace Database\Seeders;

use App\Models\Bills\Bill;
use App\Models\Expenses\Expense;
use App\Models\Incomes\Income;
use App\Models\Savings\Saving;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        Income::factory(5)->create(['user_id' => $user->id]);
        Bill::factory(10)->create(['user_id' => $user->id]);
        Expense::factory(50)->create(['user_id' => $user->id]);
        Saving::factory(3)->create(['user_id' => $user->id]);
    }
}
