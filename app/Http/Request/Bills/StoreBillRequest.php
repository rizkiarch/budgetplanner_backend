<?php

namespace App\Http\Requests\Bills;

use App\Models\Bills\Enums\BillStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
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
            'due_date' => 'required|date',
            'provider' => 'required|string|max:255',
            'status' => 'sometimes|in:' . implode(',', BillStatus::values())
        ];
    }
}
