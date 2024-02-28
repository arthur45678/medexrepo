<?php

namespace App\Http\Requests\Samples;

use Illuminate\Foundation\Http\FormRequest;

class UltrasoundEndoscopicExaminationRequest extends FormRequest
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
            'admission_date'=>'nullable|date|after:1970-01-01',
            'recommended_comment'=>'required|string|max:10000',
            'conclusion_comment'=>'required|string|max:10000',
            'description_comment'=>'required|string|max:10000',
            'research_type'=>'required|string|max:10000'
        ];
    }
}
