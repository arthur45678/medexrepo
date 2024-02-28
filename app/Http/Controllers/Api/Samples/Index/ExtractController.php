<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\Extract;
use App\Models\Samples\ExtractDiagnosisAndSurgical;
use App\Models\Samples\ExtractTreatmentList;
use App\Models\Stationary;
use Illuminate\Http\Request;


class ExtractController extends Controller
{
    public function index($patent_id)
    {

        $patient = Patient::find($patent_id);
        $post = $patient->Extract()->get();
        return response()->json(['data' => $post], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);


    }


}
