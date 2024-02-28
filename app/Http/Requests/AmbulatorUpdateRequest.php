<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbulatorUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            //     "preliminary_diagnosis" => "nullable|string|max:500",
            //     "final_diagnosis" => "nullable|string|max:500",
            //     "complaints" => "nullable|string|max:500",
            //     "disease_progression" => "nullable|string|max:500",
            //     "tumor_description" => "nullable|string|max:500",
            //     "attendances" => "nullable|array|max:200",
            //     "attendances.*" => "nullable|date|before:tomorrow",
            //     "state_reports" => "nullable|array|max:200",
            //     "state_reports.*" => "nullable|string|max:500",
            //     "has_twin" => "nullable|boolean",
        ];
    }

    public function checkFemaleIssues(): bool
    {
        return ($this->has("number_of_births") || $this->has("number_of_abortions"));
    }
}
