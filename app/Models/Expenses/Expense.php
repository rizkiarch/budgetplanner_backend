<?php

namespace App\Models\Expenses;

use App\Models\Expenses\Enums\ExpenseCategory;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Expense extends Model
{
    use HasUser, HasApiTokens;

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'date',
        'category',
        'is_recurring'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'is_recurring' => 'boolean',
        'category' => ExpenseCategory::class
    ];

    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }

    public static function forCurrentUser()
    {
        return static::where('user_id', auth()->id());
    }
}
