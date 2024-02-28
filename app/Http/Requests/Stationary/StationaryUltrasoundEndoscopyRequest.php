<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationaryUltrasoundEndoscopyRequest extends FormRequest
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
            "examination_comment" => "nullable|string|max:10000",
            "examination_date" => "nullable|date|after:1970-01-01|before:tomorrow",
            "attachments" => "nullable|array|max:10",
            "attachments.*" => "file|max:50000" // 50 MB
        ];
    }
}
