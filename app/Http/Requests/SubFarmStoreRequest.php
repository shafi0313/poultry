<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubFarmStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return user()->can('sub-farm-add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'farm_id' => 'required|integer',
            'room_no' => 'required|string',
            'name' => 'nullable|string',
        ];
    }
}
