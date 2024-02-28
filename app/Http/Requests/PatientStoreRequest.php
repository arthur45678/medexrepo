<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Put contidion based on permissions here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "f_name" => "required|string|max: 255",
            "l_name" => "required|string|max: 255",
            "p_name" => "required|string|max: 255",
            "soc_card" => "required|string"

            // "residence_region" => "required|string|max: 255",
            // "town_village" => "required|string|max: 255",
            // "street_house" => "required|string|max: 255",
            // "workplace" => "required|string|max: 255",
            // "profession" => "required|string|max: 255",
            // "birth_date" => "required|date|before:today|after:1900-01-01",
            // "passport" => "required|string|max: 255",
            // "soc_card" => "required|string|max: 255",
            // "nationality" => "required|string|max: 255",
            // "sex" => "required|string|max: 255",
            // "m_phone" => "required|string|max: 255",
            // "c_phone" => "required|string|max: 255",
        ];
    }
}
