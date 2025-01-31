<?php

namespace App\Http\Requests\Incomes;

use App\Models\Incomes\Enums\IncomeCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
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
            'date' => 'required|date',
            'category' => 'required|in:' . implode(',', IncomeCategory::values()),
            'description' => 'nullable|string|max:500'
        ];
    }
}
