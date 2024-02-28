<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;


class ErythrocyteMorphologyController extends Controller
{
    public function get__pdf(Request $request, $patient_id, $erythrocyte_morphology_id)
    {

        $patient = Patient::find($patient_id);
        $user_id = $request->get('user_id', null);
        $em = $patient->erythrocyte_morphologies()->onlyApproved($user_id)->with("attending_doctor")->find($erythrocyte_morphology_id);

        if (is_null($patient) || is_null($em)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView('samples.erythrocyte_morphology.show', compact('patient', 'em', 'for_pdf'));
        return $pdf->stream();
    }
}
