<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'f_name' => "required|string|max:191",
            'l_name' => "required|string|max:191",
            'p_name' => "required|string|max:191",

            'residence_region' => "nullable|string|max:191",
            'town_village' => "nullable|string|max:191",
            'street_house' => "nullable|string|max:191",

            'workplace' => "nullable|string|max:191",
            'profession' => "nullable|string|max:191",

            'birth_date' => "nullable|date|before:tomorrow",
            'passport' => "nullable|string|max:191",
            'soc_card' => "nullable|string",
            'nationality' => "nullable|string|max:191",
            'sex' => "nullable|string|max:191",

            'm_phone' => "nullable",
            'c_phone' => "nullable",
            'email' => "nullable|email|max:191",

            'blood_group' => "nullable|numeric|between:1,4",
            'rh_factor' => "nullable",

            # for Cancer patient control card START
            'residence_region_residence' => "nullable|string|max:191",
            'town_village_residence' => "nullable|string|max:191",
            'street_house_residence' => "nullable|string|max:191",
            'citizenship' => "nullable|string|max:191",

            'living_place_id' => "nullable|numeric",

            'social_living_condition_id' => "nullable|numeric",
            'working_feature_id' => "nullable|numeric",
            'education_id' => "nullable|numeric",
            'marital_status_id' => "nullable|numeric",
            # for Cancer patient control card EMD
        ];
    }
}
