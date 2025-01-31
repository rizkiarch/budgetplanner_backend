<?php

namespace App\Models\Income;

use App\Models\Income\Enum\IncomeCategory;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasUser;
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
}
