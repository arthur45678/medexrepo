<?php

namespace App\Http\Requests\Samples;

use Illuminate\Foundation\Http\FormRequest;

class ErythrocyteMorphologyRequest extends FormRequest
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
            'analysis_response_date'=>'nullable|date|after:1970-01-01',
            'anocytosis_comment'=>'required|string|max:10000',
            'poikilocytosis_comment'=>'required|string|max:10000',
            'basophil_comment'=>'required|string|max:10000',
            'polychromatophilia_comment'=>'required|string|max:10000',
            'jolie_bodies_comment'=>'required|string|max:10000',
            'erythronormoblasts_comment'=>'required|string|max:10000',
            'mesaloblasts_comment'=>'required|string|max:10000',
            'nuclear_over_segmentation_comment'=>'required|string|max:10000',
            'toxic_fatification_comment'=>'required|string|max:10000'
        ];
    }
}
