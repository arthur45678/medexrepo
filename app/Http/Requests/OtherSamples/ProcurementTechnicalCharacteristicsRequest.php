<?php

namespace App\Http\Requests\OtherSamples;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementTechnicalCharacteristicsRequest extends FormRequest
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
            'invitation_quota_number' => 'required',
            'procurement_plan_passcode' => 'required',
            'name_and_trademark' => 'required',
            'manufacturer_name_and_country' => 'required',
            'technical_specifications' => 'required',
            'measurement_unit' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required|gte:unit_price',
            'total_quantity' => 'required',
            'address' => 'required',
            'quantities' => 'required',
            'deadlines' => 'required',
            // 'general' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'total_price.gte' => 'Միավորի գինը չի կարող գերազանցել ընդհանուր գինը։',
        ];
    }
}
