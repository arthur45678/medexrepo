<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferralStoreRequest extends FormRequest
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
        /**
         * referral_wrap_length - ուղեգրերի քանակ
         * service_wrap_length - երկչափ զանգված - ծառայութնունների քանակ
         */

        return [
            "referral_wrap_length" => "required|numeric",

            "department_id" => "required|array",
            "department_id.*" => "nullable|numeric|exists:departments,id",

            "receiver_id" => "required|array",
            "receiver_id.*" => "nullable|numeric|exists:users,id",

            # array of services-length of each referral
            "service_wrap_length" => "required|array",
            "service_wrap_length.*" => "required|numeric",

            # array in array - 2 dimentional array
            "service_id" => "required|array",
            "service_id.*" => "required|array",
            "service_id.*.*" => "nullable|exists:services,id",

            "payment_type" => "required|array",
            "payment_type.*" => "required|array",
            "payment_type.*.*" => "nullable|string",

            "comment" => "required|array",
            "comment.*" => "required|array",
            "comment.*.*" => "nullable|string|max:10000",
        ];
    }
}
