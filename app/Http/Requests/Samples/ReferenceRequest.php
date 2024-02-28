<?php

namespace App\Http\Requests\Samples;

use Illuminate\Foundation\Http\FormRequest;

class ReferenceRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'attending_doctor_id' => 'nullable|numeric|exists:users,id',
            'department_head_id' => 'nullable|numeric|exists:users,id',
            'chief_doctor_id' => 'nullable|numeric|exists:users,id',
            'reference_diagnosis' =>'required|string|max:10000',
            'treatment' =>'required|string|max:10000',
            'doctor_advice' =>'required|string|max:10000',
            'from_date' => 'nullable|numeric|exists:users,id',
            'to_date' => 'nullable|numeric|exists:users,id',
            'date' => 'nullable|numeric|exists:users,id',
        ];
    }
}
