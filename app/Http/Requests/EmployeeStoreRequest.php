<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return user()->can('employee-add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'f_name' => ['required', 'string'],
            'm_name' => ['required', 'string'],
            'employee_cat_id' => ['required', 'integer'],
            'job_loc' => ['required', 'string'],
            'd_o_b' => ['required', 'date'],
            'nid' => ['required','integer'],
            'blood' => ['required', 'string', 'max:10'],
            'm_status' => ['required'],
            'c_phone' => ['nullable'],
            'j_date' => ['required'],
            'place' => ['required'],
            'g_name' => ['nullable'],
            'g_phone' => ['nullable'],
            'relation' => ['nullable'],
            'place' => ['nullable'],
            'p_address' => ['required'],
            'basic_pay' => ['nullable'],
            'house_rent' => ['nullable'],
            'medical_a' => ['nullable'],
            'bonus' => ['nullable'],
            'total' => ['nullable'],
        ];
    }
}
