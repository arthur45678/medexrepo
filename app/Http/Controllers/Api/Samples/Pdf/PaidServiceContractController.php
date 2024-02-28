<?php
namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;

use App\Models\Patient;

use App\Models\Samples\PaidServiceContract;
use App\Models\Samples\PaidServiceContractsServiceAndDoctor;
use PDF;

class PaidServiceContractController extends Controller
{
    public function get_pdf($patient_id, $paid_id)
    {




        $for_pdf = true;
        $patient = Patient::find($patient_id);
        $PaidService = PaidServiceContract::where('patient_id', $patient->id)->find($paid_id);
        if ($PaidService==null) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $services = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'service')->get();
        $doctors = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'doctor')->get();

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.paid_service_contract.show",compact('PaidService', 'patient', 'services', 'doctors','for_pdf'));

        return $pdf->stream();
    }








}

