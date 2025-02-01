<?php

namespace App\Http\Requests\Savings;

use App\Models\Savings\Enums\SavingGoalType;
use Illuminate\Foundation\Http\FormRequest;

class StoreSavingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'goal_amount' => 'required|numeric|min:0',
            'target_date' => 'required|date',
            'goal_type' => 'required|in:' . implode(',', SavingGoalType::values())
        ];
    }
}
