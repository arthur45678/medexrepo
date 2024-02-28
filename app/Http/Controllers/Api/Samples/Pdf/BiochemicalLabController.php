<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Samples\BiochemicalLabN1;
use App\Models\Patient;
use App\Models\Approvement;
use Illuminate\Http\Request;
use PDF;
class BiochemicalLabController extends Controller
{

    public function get_1_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n1()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n1.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_2_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n2()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n2.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_3_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n3()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n3.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_4_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n4()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n4.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_5_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n5()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n5.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_7_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n7()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n7.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_8_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n8()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n8.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }
    public function get_9_pdf($patient_id, $id)
    {
        $for_pdf=true;
        $patient = Patient::find($patient_id);
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $bl = $patient->biochemical_labs_n9()->findOrFail($id);
        if ($bl==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView("samples.biochemical_lab_n9.show", compact('for_pdf','patient', 'bl', 'ambulator_id', 'all_stationary_id'));
        return $pdf->stream();
    }

}
