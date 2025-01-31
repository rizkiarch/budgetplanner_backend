<?php

namespace App\Http\Requests\Incomes;

use App\Models\Incomes\Enums\IncomeCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric|min:0',
            'date' => 'sometimes|date',
            'category' => 'sometimes|in:' . implode(',', IncomeCategory::values()),
            'description' => 'nullable|string|max:500'
        ];
    }
}
