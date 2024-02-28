<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\StationaryInpatientDiagnosis;
use App\Models\Samples\StationaryInpatientRegister;
use App\Models\Stationary;
use App\Models\TreatmentList;
use App\Models\TumorTreatmentList;
use Illuminate\Http\Request;
use PDF;

class StationaryInpatientRegisterController extends Controller
{
    public function get_pdf($patent_id,$id)
    {
        $inpatient = StationaryInpatientRegister::with(['Tumorlists'])->find($id);
        $inpatient_diagnos = StationaryInpatientDiagnosis::where('inpatient_id',$id)->get();
        $patent = Patient::find($patent_id);
        $tumorlists=TreatmentList::where('id',$inpatient->treatment_id)->first();
        if ($inpatient==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.stationary_inpatient_register.show", compact('patent','inpatient_diagnos','inpatient','tumorlists','for_pdf'));
        return $pdf->stream();

    }

}
