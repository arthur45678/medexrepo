<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use PDF;

class XrayExaminationLogController extends Controller
{
    public function get_pdf($patient_id, $id)
    {

        $for_pdf = true;
        $patient = Patient::find($patient_id);

        $xray = $patient->xray_examination_logs()->find($id);
        if ($xray==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.xray_examination_log.show",compact('xray','for_pdf'));

        return $pdf->stream();
    }
}
