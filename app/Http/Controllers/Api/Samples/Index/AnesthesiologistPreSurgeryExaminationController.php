<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Samples\AnesthesiologDiagnosis;

use PDF;

class AnesthesiologistPreSurgeryExaminationController extends Controller
{
    public function index($patient_id){

        $patient = Patient::find($patient_id);
        $apse = $patient->anesthesiology_presurgery_examinations()->get();
        return response()->json(['data' => $apse], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
