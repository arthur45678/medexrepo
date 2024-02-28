<?php


namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PersonalTreatmentMedication;
use App\Models\Samples\PersonalTreatmentPlan;
use Illuminate\Http\Request;
use PDF;

class PersonalTreatmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_pdf($patent_id, $id)
    {
        $for_pdf = true;
        $plan=PersonalTreatmentPlan::find($id);
        $patent = Patient::find($patent_id);
        $surgery=PersonalTreatmentMedication::with(['medicine_name'])->where('type','surgery')->where('treatment_id',$id)->get();
        $chemotherapy=PersonalTreatmentMedication::with(['medicine_name'])->where('type','chemotherapy')->where('treatment_id',$id)->get();
        $radiation=PersonalTreatmentMedication::with(['medicine_name'])->where('type','radiation')->where('treatment_id',$id)->get();
        $diagnostic=PersonalTreatmentMedication::with(['medicine_name'])->where('type','diagnostic')->where('treatment_id',$id)->get();

        if (is_null($patent) || is_null($plan)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.personal_treatment_plan.show",
            compact('plan','patent','surgery','chemotherapy','radiation','diagnostic','for_pdf'));


        return $pdf->stream();




    }

}
