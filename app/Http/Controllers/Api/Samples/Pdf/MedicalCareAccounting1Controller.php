<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Patient;
use App\Models\Stationary;
use App\Models\Samples\MedicalCareMedicineAndSource;
use App\Models\Scholarships_list;
use App\Models\Samples\MedicalCareMedicineLabService;

use PDF;


class MedicalCareAccounting1Controller extends Controller
{
    public function get_pdf($patient_id,$id)
    {
        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $medicalCareAccounting = $patient->MedicalCareAccounting()->find($id);
        if ($medicalCareAccounting==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $stationaries=Stationary::find($medicalCareAccounting->stationary_id);
        $medicineData=MedicalCareMedicineAndSource::where('parent_id',$id)->get();
        $scholarships=Scholarships_list::where('status','active')->get();
        $labService=MedicalCareMedicineLabService::where('parent_id',$id)->get();

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.medical_care_accounting1.show",compact('patient',
            'scholarships','medicalCareAccounting','medicineData','labService','stationaries','for_pdf'));
        return $pdf->stream();

    }
}
