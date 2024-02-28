<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Patient;
use App\Models\Samples\ImmunologicalExaminationPatternN1;
use App\Models\Samples\ImmunologicalExaminationPatternN3;
use App\Models\Samples\ImmunologicalExaminationPatternN4;
use App\Models\Samples\ImmunologicalExaminationPatternN5;
use App\Models\Samples\ImmunologicalExaminationPatternN7;
use App\Models\Samples\ImmunologicalExaminationPatternN8;
use App\Models\Stationary;
use Illuminate\Http\Request;
use PDF;

class ImmunologicalExaminationPatternController extends Controller
{
    public function get_im1($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN1::where('patient_id', $patent_id)->get();
        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }


    public function get_im3($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN3::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
    public function get_im4($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN4::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
    public function get_im5($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN5::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
    public function get_im7($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN7::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
    public function get_im8($patent_id){

        $patient=Patient::find($patent_id);

        $immunologia = ImmunologicalExaminationPatternN8::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $immunologia], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }


}
