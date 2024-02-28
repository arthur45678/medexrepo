<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\DrugDestructionAct;
use App\Models\Samples\Echocardiogram;
use Illuminate\Http\Request;
use PDF;

class DrugDestructionActController extends Controller
{

    public function get_pdf($patient_id, $id)
    {
        $patient = Patient::find($patient_id);
        $post = $patient->drug_destruction_act()->find($id);

        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.drug_destruction_act.show", compact( 'post','for_pdf'));
        return $pdf->stream();
    }

}
