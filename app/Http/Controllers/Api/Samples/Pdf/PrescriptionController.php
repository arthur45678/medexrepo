<?php

namespace App\Http\Controllers\Api\Samples\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MeasurementUnit;
use App\Models\Samples\No_Medication;
use App\Models\Patient;
use App\Models\Samples\PrescriptionModels;
use PDF;
class PrescriptionController extends Controller
{
    public function get_pdf($patient_id,$id)
    {

        $for_pdf = true;
        $patient1 = Patient::find($patient_id);
        $sheet =  $patient1->assignment_sheet()->find($id);
        //return $sheet;
        if ($sheet==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $departments = Department::get();
        //$sheet = AppointmentSheetMode::with(['departments'])->find($id);
        $noMedication = No_Medication::where('appointment_sheet_id', $sheet->id)->get();
        $patient = Patient::find($sheet->patient_id);
        $prescraption = PrescriptionModels::where('appointment_sheet_id', $sheet->id)->get();
        $measurement_units = MeasurementUnit::get();
        //return $measurement_units;

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView('samples.prescription.show',compact('sheet', 'for_pdf', 'patient', 'noMedication', 'prescraption','measurement_units'));

        return $pdf->stream();

    }

}
