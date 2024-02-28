<?php


namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Samples\MedicalWasteRegister;
use Illuminate\Http\Request;
use App\Models\Patient;
use PDF;

class MedicalWasteRegisterController extends Controller
{


    public function get_pdf($patient_id, $id)
    {   $for_pdf = true;
        $patient = Patient::find($patient_id);
        $post = $patient->medical_waste_register()->find($id);
        if ($post==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.medical_waste_register.show",compact('post','for_pdf'));

        return $pdf->stream();
    }
}
