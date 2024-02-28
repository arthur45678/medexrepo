<?php
namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use PDF;


class HeatSheetController extends Controller
{
    /*public function get_pdf(Patient $patient, $id)
    {
        return $patient;
        $post = $patient->heat_sheet()->findOrFail($id);


        return view("samples.heat_sheet.show",compact('post','charts'));

    }*/
    public function get_pdf($patient_id, $id)
    {

        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $post = $patient->heat_sheet()->find($id);
        $charts = $post->heat_sheet_charts()->orderBy('day','ASC')->get();
        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.heat_sheet.show",compact('post','charts','for_pdf'));

        return $pdf->stream();
    }

}
