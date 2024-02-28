<?php
namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\BixSterilizationLog;
use Illuminate\Http\Request;

class AgreementHospitalRoomController extends Controller
{
    public function index($patient_id)
    {
        $patient = Patient::find($patient_id);

        $post = $patient->AgreementHospitalRoom()->get();

        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}

