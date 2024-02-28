<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Samples\AnesthesiologDiagnosis;
use PDF;

class AnesthesiologistPreSurgeryExaminationController extends Controller
{
    public function get_ape_pdf1($patient_id, $apse_id)
    {
        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $lates_stationary = $patient->stationaries()->latest()->first();

        $apse = AnesthesiologistPreSurgeryExamination::find($apse_id);
        $anestologia_a = AnesthesiologDiagnosis::where('type', 'a')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_b = AnesthesiologDiagnosis::where('type', 'b')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_c = AnesthesiologDiagnosis::where('type', 'c')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_d = AnesthesiologDiagnosis::where('type', 'd')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_e = AnesthesiologDiagnosis::where('type', 'e')->where('anesthesiolog_id', $apse_id)->get();
        if (is_null($patient) || is_null($apse)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.anesthesiology.show", compact('patient', 'apse', 'lates_stationary',
            'anestologia_a', 'anestologia_b', 'anestologia_c', 'anestologia_d', 'anestologia_e', 'for_pdf'));


        return $pdf->stream();

    }
}
