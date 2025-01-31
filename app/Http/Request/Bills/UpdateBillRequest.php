use Illuminate\Foundation\Http\FormRequest;

<?php

namespace App\Http\Requests\Bills;

use App\Models\Bills\Enums\BillStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can add your authorization logic here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'provider' => 'required|string|max:255',
            'status' => 'sometimes|in:' . implode(',', BillStatus::values()),
        ];
    }
}
