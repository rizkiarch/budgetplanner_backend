<?php

namespace App\Models\Incomes;

use App\Models\Incomes\Enums\IncomeCategory;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Income extends Model
{
    use HasUser, HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'date',
        'category',
        'description'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'category' => IncomeCategory::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function forCurrentUser()
    {
        return static::where('user_id', auth()->id());
    }
}
