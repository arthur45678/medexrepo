<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\BixSterilizationLog;
use App\Models\Samples\ConsciousVoluntaryConsent;
use Illuminate\Http\Request;
use PDF;

class ConsciousVoluntaryConsentController extends Controller
{
    public function index($patent_id){

        $patient = Patient::find($patent_id);
        $post = $patient->conscious_voluntary_consents()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }



}
