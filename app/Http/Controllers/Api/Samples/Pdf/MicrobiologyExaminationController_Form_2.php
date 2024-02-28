<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use PDF;

class MicrobiologyExaminationController_Form_2 extends Controller
{
    public function get_pdf($patient_id, $id)
    {

        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $post = $patient->microbiology_examination_form_2()->find($id);

        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.microbiology_examination_form_2.show",compact('post','for_pdf'));

        return $pdf->stream();
    }
}
