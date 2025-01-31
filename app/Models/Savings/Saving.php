<?php

namespace App\Models\Savings;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasUser;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'date',
        'goal_amount',
        'target_date',
        'goal_type'
    ];

    protected $casts = [
        'date' => 'date',
        'target_date' => 'date',
        'amount' => 'decimal:2',
        'goal_amount' => 'decimal:2',
        'goal_type' => SavingGoalType::class
    ];

    public function progressPercentage(): float
    {
        return ($this->amount / $this->goal_amount) * 100;
    }
}
