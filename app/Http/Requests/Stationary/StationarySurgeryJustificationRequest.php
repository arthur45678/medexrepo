<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationarySurgeryJustificationRequest extends FormRequest
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
            "justification" => "nullable|string|max:65000",
            "date" => "nullable|date|before:tomorrow|after:1970-01-01",
            "attending_doctor_id" => "nullable|numeric|exists:users,id",
            "department_head_id" => "nullable|numeric|exists:users,id",
            "medical_affairs_deputy_director_id" => "nullable|numeric|exists:users,id"
        ];
    }
}
