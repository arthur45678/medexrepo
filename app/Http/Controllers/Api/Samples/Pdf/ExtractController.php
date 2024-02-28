<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\Extract;
use App\Models\Samples\ExtractDiagnosisAndSurgical;
use App\Models\Samples\ExtractTreatmentList;
use App\Models\Stationary;
use Illuminate\Http\Request;
use PDF;

class ExtractController extends Controller
{

    public function get_pdf($patient_id, $id)
    {

        $extract=Extract::find($id);
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator = Ambulator::find($extract->stationary_id);
        $stationaries = Stationary::find($extract->ambulator_id);
        $treatment_c = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'radial')->get();
        $treatment_c2 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'complex')->get();
        $treatment_c3 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'other')->get();
        $period = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'diagnosis')->get();
        $period2 = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'surgicals')->get();
        if ($extract==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.extract.show", compact('stationaries', 'ambulator'
            , 'patient', 'extract', 'treatment_c', 'treatment_c2', 'treatment_c3', 'period', 'period2','for_pdf'));
        return $pdf->stream();


    }


}
