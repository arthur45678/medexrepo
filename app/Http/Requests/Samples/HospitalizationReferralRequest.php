<?php

namespace App\Http\Requests\Samples;

use Illuminate\Foundation\Http\FormRequest;

class HospitalizationReferralRequest extends FormRequest
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
            'diagnosis' =>'required|string|max:10000',
            'medical_measure' =>'required|string|max:10000',
            'accept' => 'nullable|boolean',
            'referral_date' => 'nullable|numeric|exists:users,id',
        ];
    }
}
