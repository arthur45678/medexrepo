<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return $this->user()->can('update users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'p_name' => 'required|string',
            'department_id' => 'required|numeric',

            'residence_region' => 'nullable|string',
            'town_village' => 'nullable|string',
            'street_house' => 'nullable|string',

            'degree' => 'nullable|string',
            'position' => 'nullable|string',

            'birth_date' => 'nullable|date',
            'passport' => 'nullable|string',
            'soc_card' => 'nullable|string',
            'nationality' => 'nullable|string',
            'is_male' => 'nullable|boolean',

            'm_phone' => 'nullable|string',
            'c_phone' => 'nullable|string',
            'email' => 'nullable|email'
        ];
    }
}
