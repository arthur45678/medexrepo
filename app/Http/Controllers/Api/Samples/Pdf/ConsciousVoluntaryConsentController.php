<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\BixSterilizationLog;
use App\Models\Samples\ConsciousVoluntaryConsent;
use Illuminate\Http\Request;
use PDF;

class ConsciousVoluntaryConsentController extends Controller
{


    public function get_pdf($patient_id, $id)
    {

        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $post = $patient->conscious_voluntary_consents()->findOrFail($id);
        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.conscious_voluntary_consents.show", compact('post','for_pdf'));
        return $pdf->stream();
    }
}
