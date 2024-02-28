<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PlanningDiagnosisModel;
use App\Models\Samples\PlanningProtocol;
use Illuminate\Http\Request;
use PDF;

class PlanningProtocolController extends Controller
{

    public function get_pdf($patent_id,$id)
    {


        $for_pdf = true;
        $planing = PlanningProtocol::where('patient_id', $patent_id)->find($id);

        $planingdiagnostic = PlanningDiagnosisModel::where('planning_id', $id)->get();
        $patent = Patient::find($patent_id);
        if (is_null($patent) || is_null($planing)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
       PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.planning_protocol.show", compact('patent', 'planing', 'planingdiagnostic','for_pdf'));


        return $pdf->stream();
    }

}
