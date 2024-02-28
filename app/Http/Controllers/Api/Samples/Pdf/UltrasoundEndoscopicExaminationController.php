<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;

class UltrasoundEndoscopicExaminationController extends Controller
{

    public function get_uex_pdf(Request $request, $patient_id, $uex_id)
    {
        $patient = Patient::find($patient_id);
        $user_id = $request->get('user_id', null);
        // return response()->json(['dede' => $user_id]);
        $uex = $patient->ultrasound_endoscopic_examinations()->onlyApproved($user_id)->find($uex_id);
        $for_pdf = true;
        // return view("samples.ultrasound_endoscopic_examination.show")->with(compact('patient', 'uex'));

        if (is_null($patient) || is_null($uex)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView('samples.ultrasound_endoscopic_examination.show', compact('patient', 'uex', 'for_pdf'));
        return $pdf->stream();

        // $date = date('Y-m-d', strtotime( $uex->date) ) .'_'. date("h-i-s");
        // return $pdf->download('uex_down_'.$date.'.pdf');
    }
}
