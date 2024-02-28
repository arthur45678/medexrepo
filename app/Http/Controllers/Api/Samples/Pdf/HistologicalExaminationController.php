<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\HistologicalExamination;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Approvement;
use PDF;

class HistologicalExaminationController extends Controller
{

    public function get_pdf($patient_id, $id)
    {

        $patient = Patient::find($patient_id);
        $post = $patient->histological_examinations()->findOrFail($id);
        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.histological_examination.show", compact('post','for_pdf'));
        return $pdf->stream();
    }
}
