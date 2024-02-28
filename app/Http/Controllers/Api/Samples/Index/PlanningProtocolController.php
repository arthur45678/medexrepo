<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PlanningDiagnosisModel;
use App\Models\Samples\PlanningProtocol;
use Illuminate\Http\Request;
use PDF;

class PlanningProtocolController extends Controller
{
    public function index($patient_id){



        $patient = Patient::find($patient_id);
        $post =  $patient->PlanningProtocols()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }





}
