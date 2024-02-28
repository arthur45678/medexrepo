<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationaryPrimaryExaminationRequest extends FormRequest
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
            "examination_date" => "nullable|date|before:tomorrow|after:1970-01-01",
            "complaints" => "nullable|string|max:10000",
            "anamnesis_morbi" => "nullable|string|max:10000",
            "growth_and_development" => "nullable|string|max:10000",
            "inheritance" => "nullable|string|max:10000",
            "sextual_history" => "nullable|string|max:10000",

            "menarche_age" => "nullable|numeric|min:0|max:254",
            "last_mensis" => "nullable|date|before:tomorrow|after:1970-01-01",
            "menopausa_age" => "nullable|numeric|min:0|max:254",
            "number_of_pregnancies" => "nullable|numeric|min:0|max:254",
            "number_of_abortions" => "nullable|numeric|min:0|max:254",
            "number_of_interruptions" => "nullable|numeric|min:0|max:254",
            "number_of_births" => "nullable|numeric|min:0|max:254",

            // "breast_feeding",
            "breast_feeding_comment" => "nullable|string|max:10000",

            // "taking_hormonal_drugs",
            "taking_hormonal_drugs_comment" => "nullable|string|max:10000",

            // "previous_disease_ids.*" => "numeric"
        ];
    }
}
