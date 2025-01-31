<?php

namespace App\Http\Requests\Expenses;

use App\Models\Expenses\Enums\ExpenseCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|in:' . implode(',', ExpenseCategory::values()),
            'is_recurring' => 'sometimes|boolean'
        ];
    }
}
