<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\HistologicalExamination;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Approvement;
use PDF;

class HistologicalExaminationController extends Controller
{

    public function index($patient_id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $post =  $patient->histological_examinations()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
