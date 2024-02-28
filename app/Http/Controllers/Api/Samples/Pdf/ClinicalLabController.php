<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Samples\ClinicalLabN2;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;
use PDF;

class ClinicalLabController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function get_pdf_n2($patient_id, $id)
    {

        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = $patient->ambulator->number;
        $all_stationary_id = $patient->stationaries->pluck('number');
        $cl = $patient->clinical_labs_n2()->find($id);

        if ($cl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.clinical_lab_n2.show", compact('patient', 'cl', 'ambulator_id', 'all_stationary_id','for_pdf'));
        return $pdf->stream();



    }
    public function get_pdf_n11($patient_id, $id)
    {

        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = $patient->ambulator->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $cl = $patient->clinical_labs_n11()->find($id);

        if ($cl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.clinical_lab_n11.show", compact('patient', 'cl', 'ambulator_id', 'all_stationary_id','for_pdf'));
        return $pdf->stream();



    }
    public function get_pdf_n12($patient_id, $id)
    {

        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = $patient->ambulator->number;
        $all_stationary_id = $patient->stationaries->pluck('number');
        $cl = $patient->clinical_labs_n12()->find($id);

        if ($cl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.clinical_lab_n12.show", compact('patient', 'cl', 'ambulator_id', 'all_stationary_id','for_pdf'));
        return $pdf->stream();



    }


}
