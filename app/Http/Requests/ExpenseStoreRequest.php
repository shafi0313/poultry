<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'farm_id'     => 'required|integer',
            'sub_farm_id' => 'nullable|integer',
            'expense_cat_id'     => 'required|integer',
            'date'      => 'required|date',
            'amount'      => 'required|numeric',
        ];
    }
}
