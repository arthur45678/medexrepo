<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use PDF;

class AgreementHospitalRoomController extends Controller
{
    public function get_pdf($patient_id, $id)
    {
        $for_pdf = true;
        $patient = Patient::find($patient_id);
        //return $patient;
        $agreem = $patient->AgreementHospitalRoom()->find($id);

        if ($agreem==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.agreement_hospital_room.show",compact('agreem','for_pdf', 'patient'));

        return $pdf->stream();
    }
}
