<?php

namespace App\Http\Controllers\Api\Samples\Index;

use App\Http\Controllers\Controller;
use App\Models\Samples\ErythrocyteMorphology;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;


class ErythrocyteMorphologyController extends Controller
{
    public function index($patent_id){

        $patient=Patient::find($patent_id);

        $list = ErythrocyteMorphology::where('patient_id', $patent_id)->get();

        return response()->json(['data' => $list], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
