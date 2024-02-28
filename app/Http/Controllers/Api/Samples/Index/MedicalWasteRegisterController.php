<?php


namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\MedicalWasteRegister;
use Illuminate\Http\Request;
use App\Models\Patient;

class MedicalWasteRegisterController extends Controller
{




    public function index($patient_id){



        $patient = Patient::find($patient_id);
        $post =  $patient->medical_waste_register()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

}
