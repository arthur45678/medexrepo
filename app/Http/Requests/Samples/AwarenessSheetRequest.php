<?php

namespace App\Http\Requests\Samples;

use Illuminate\Foundation\Http\FormRequest;

class AwarenessSheetRequest extends FormRequest
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
            'department_head_id_id' => 'nullable|numeric|exists:users,id',
            'first_date'=>'nullable|date|after:1970-01-01',
            'second_date'=>'nullable|date|after:1970-01-01',
            'service_recipient'=>'required|string|max:10000',
            'accept' => 'nullable|boolean',
        ];
    }
}
