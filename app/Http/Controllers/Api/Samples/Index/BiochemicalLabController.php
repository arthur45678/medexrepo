<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\BiochemicalLabN1;
use App\Models\Patient;
use App\Models\Approvement;
use Illuminate\Http\Request;

class BiochemicalLabController extends Controller
{

    public function get_1_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n1()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_2_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n2()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_3_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n3()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_4_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n4()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_5_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n5()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_7_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n7()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_8_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n8()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
    public function get_9_pdf($patient_id)
    {
        $patient = Patient::find($patient_id);
        $post =  $patient->biochemical_labs_n9()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }

}
