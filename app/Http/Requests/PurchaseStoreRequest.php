<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest
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
            'type'          => ['required', Rule::in(['chicken', 'feed'])],
            'supplier_id'   => ['required'],
            'farm_id'   => ['required'],
            'sub_farm_id'   => ['required'],
            // 'sub_farm_id'   => ['required', 'integer', 'not_in:0','regex:^[1-9][0-9]+'],
            'date'          => ['date'],
            'quantity'      => ['required'],
        ];
    }
}
