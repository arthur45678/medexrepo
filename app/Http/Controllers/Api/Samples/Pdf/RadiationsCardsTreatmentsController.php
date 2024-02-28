<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;

class RadiationsCardsTreatmentsController extends Controller
{
    public function get_radiation_treatment_card_pdf($patient_id, $rtc_id)
    {
        $patient = Patient::find($patient_id);
        $card = $patient->radiation_treatment_card()->find($rtc_id);

        if (is_null($patient) || is_null($card)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView('samples.radiation_treatment_cards.show', compact('patient', 'card', 'for_pdf'));
        return $pdf->stream();
    }
}
