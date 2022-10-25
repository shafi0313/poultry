<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesStoreRequest extends FormRequest
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
            // 'supplier_id'   => ['required'],
            'farm_id'       => ['required'],
            'sub_farm_id'   => ['required'],
            'date'          => ['date'],
            'do'            => ['required'],
            'crate'         => ['required'],
            'quantity'         => ['required'],
        ];
    }
}
