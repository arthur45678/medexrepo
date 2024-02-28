<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\ClinicalLabN2;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;


class ClinicalLabController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function get_index_n2($patent_id)
    {

        $patient = Patient::find($patent_id);
        $post = $patient->clinical_labs_n2()->with("attending_doctor")->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);


    }
    public function get_index_n11($patent_id)
    {

        $patient = Patient::find($patent_id);
        $post = $patient->clinical_labs_n11()->with("attending_doctor")->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);


    }
    public function get_index_n12($patent_id)
    {

        $patient = Patient::find($patent_id);
        $post = $patient->clinical_labs_n12()->with("attending_doctor")->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);


    }

}
