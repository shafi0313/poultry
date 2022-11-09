<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalSalesStoreRequest extends FormRequest
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
            'farm_id' => 'required',
            'sub_farm_id' => 'required',
            'age' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ];
    }
}
