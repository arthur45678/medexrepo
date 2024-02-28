<?php
namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Http\Controllers\Controller;

use App\Models\Samples\AdviceSheet;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use PDF;

class AdviceSheetController extends Controller
{
    public function get_pdf($patient_id, $id)
    {
        $for_pdf = true;
        $patient = Patient::find($patient_id);

        $post = $patient->advice_sheet()->find($id);

        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $samplesDiagnosis = SampleDiagnose::where(['card_id' => $post->id,
            'diagnosable_type' => SampleDiagnosesEnum::advice_sheet_diagnosis()])->get();
        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.advice_sheet.show",compact('post','for_pdf', 'samplesDiagnosis'));

        return $pdf->stream();

    }

}
