<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use PDF;

class SterilizationModeSisterController extends Controller
{
    public function get_pdf($patient_id, $id)
    {

        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $steril = $patient->sterilization_mode_sisters()->find($id);
        if ($steril==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.sterilization_mode_sister.show",compact('steril','for_pdf'));

        return $pdf->stream();
    }
}
