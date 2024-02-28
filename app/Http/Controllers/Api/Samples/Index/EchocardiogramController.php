<?php

namespace App\Http\Controllers\Api\Samples\Index;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\Echocardiogram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class EchocardiogramController extends Controller
{



    public function index($patent_id){

        $patient = Patient::find($patent_id);
        $post = $patient->echo_cardiograms()->get();
    return response()->json(['data' => $post], 200, [
        'Content-Type' => 'application/json;charset=UTF-8',
        'Charset' => 'utf-8'
    ], JSON_UNESCAPED_UNICODE);
}
}


