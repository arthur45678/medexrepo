<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Patient;
use App\Models\Samples\ImmunologicalExaminationPatternN1;
use App\Models\Samples\ImmunologicalExaminationPatternN3;
use App\Models\Samples\ImmunologicalExaminationPatternN4;
use App\Models\Samples\ImmunologicalExaminationPatternN5;
use App\Models\Samples\ImmunologicalExaminationPatternN7;
use App\Models\Samples\ImmunologicalExaminationPatternN8;
use App\Models\Stationary;
use Illuminate\Http\Request;
use PDF;

class ImmunologicalExaminationPatternController extends Controller
{

    public function iep1($patent_id,$id)
    {
        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN1::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n1.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }


    public function iep3($patent_id,$id)
    {
        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN3::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n3.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }
    public function iep4($patent_id,$id)
    {

        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN4::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n4.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }
    public function iep5($patent_id,$id)
    {
        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN5::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n5.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }
    public function iep7($patent_id,$id)
    {
        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN7::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n7.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }
    public function iep8($patent_id,$id)
    {
        $for_pdf=true;
        $immunologia = ImmunologicalExaminationPatternN8::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);

        PDf::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView("samples.immunological_examination_pattern_n8.show", compact('immunologia','patent','amboulator','stationarie','for_pdf'));
        return $pdf->stream();
    }
}
