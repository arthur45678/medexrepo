<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\ImmunologicalExaminationPatternN1;
use App\Models\Samples\UltrasoundEndoscopicExamination;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;

class UltrasoundEndoscopicExaminationController extends Controller
{

    public function index($patent_id){

        $patient=Patient::find($patent_id);

        $uex = UltrasoundEndoscopicExamination::where('patient_id', $patent_id)->get();
        return response()->json(['data' => $uex], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
