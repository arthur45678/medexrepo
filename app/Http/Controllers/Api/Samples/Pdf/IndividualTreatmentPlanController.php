<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;

use App\Models\Samples\IndividualTreatmentPlansService;
use App\Models\Samples\IndividualTreatmentPlansTreatmentList;
use App\Models\Samples\IndividualTreatmentPlansAppointmentsList;
use PDF;

class IndividualTreatmentPlanController extends Controller
{

    public function get_pdf($patient_id, $indivdual_id)
    {
        $for_pdf = true;
        $indivdual=Patient::find($patient_id);
        $patient = $indivdual->IndividualTreatmentPlan()->find($indivdual_id);

        if ($patient==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $indivdual_service_laboratory=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','laboratory')->first();
        $indivdual_service_instrumental=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','instrumental')->first();

        $indivdual_service_radiation=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_service_histological=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','histological')->first();
        $indivdual_treatment_radiation=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_treatment_chemotherapy=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->first();
        $indivdual_appointments_surgical=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','surgical')->get();
        $indivdual_appointments_chemotherapy=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->get();
        $indivdual_appointments_radiation=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','radiation')->get();
        $indivdual_appointments_control=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','control')->get();

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.individual_treatment_plan.show",compact('patient','indivdual_id','indivdual',
            'indivdual_service_histological','indivdual_service_instrumental','indivdual_service_laboratory','indivdual_service_radiation',
            'indivdual_treatment_chemotherapy','indivdual_treatment_radiation'
            , 'indivdual_appointments_surgical','indivdual_appointments_chemotherapy','indivdual_appointments_radiation','indivdual_appointments_control','for_pdf'
        ));

        return $pdf->stream();


    }
}
