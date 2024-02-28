<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Samples\MicrobiologyExamination;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class MicrobiologyExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient = Patient::find($patient_id);

        $microbiology_examination =  $patient->microbiology_examination;
        return response()->json(['data' => $microbiology_examination], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

}
