<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationaryEpicrisisRequest extends FormRequest
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
            "epicrisis_date" => "nullable|date|before:tomorrow|after:1970-01-01",
            "epicrisis" => "nullable|string|max:65000",

            "attending_doctor_id" => "nullable|numeric|exists:users,id",
            "department_head_id" => "nullable|numeric|exists:users,id",
            "chief_doctor_id" => "nullable|numeric|exists:users,id"
        ];
    }
}
