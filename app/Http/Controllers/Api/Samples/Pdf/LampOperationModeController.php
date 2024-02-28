<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\LampOperationMode;
use Illuminate\Http\Request;
use PDF;

class LampOperationModeController extends Controller
{

    public function get_pdf($patient_id, $id)
    {

        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $lamp = $patient->LampOperationMode()->get();
        if ($lamp==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.lamp_operation_mode.show",compact('lamp','for_pdf'));
        return $pdf->stream();
    }
}
