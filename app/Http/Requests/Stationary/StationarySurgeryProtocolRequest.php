<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationarySurgeryProtocolRequest extends FormRequest
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
            "user_id" => "nullable|numeric|exists:users,id",
            "anesthesiologist_id" => "nullable|numeric|exists:users,id",

            "date" => "nullable|date|before:tomorrow|after:1970-01-01",
            "surgery_id" => "nullable|numeric|exists:surgery_lists,id",
            "surgery_name" => "nullable|string|max:65000",
            "surgery_start" => "nullable|date_format:Y-m-d\TH:i",
            "surgery_end" => "nullable|date_format:Y-m-d\TH:i",

            "anesthesia_id" => "nullable|numeric|exists:anesthesia_lists,id",
            "medicine_id" => "nullable|numeric|exists:medicine_lists,id",
            "anesthesia_process" => "nullable|string|max:65000"
        ];
    }
}
