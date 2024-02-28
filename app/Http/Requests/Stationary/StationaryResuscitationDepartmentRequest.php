<?php

namespace App\Http\Requests\Stationary;

use Illuminate\Foundation\Http\FormRequest;

class StationaryResuscitationDepartmentRequest extends FormRequest
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
            "date" => "nullable|date|before:tomorrow|after:1970-01-01",
            "comment" => "nullable|string|max:10000",
        ];
    }
}
