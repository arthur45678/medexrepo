<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\StationaryInpatientDiagnosis;
use App\Models\Samples\StationaryInpatientRegister;
use App\Models\Stationary;
use App\Models\TreatmentList;
use App\Models\TumorTreatmentList;
use Illuminate\Http\Request;
use PDF;

class StationaryInpatientRegisterController extends Controller
{
    public function index($patient_id)
    {

        $patient = Patient::find($patient_id);
        $post =  $patient->StationaryInpatientRegisters()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

}
