<?php

namespace App\Http\Controllers\Api\Samples\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\ExpressPaterrn;
use Illuminate\Http\Request;
use PDF;



class ExpressPaterrnController extends Controller
{

    public function get_pdf($patent_id,$id)
    {


        $expres_parent=ExpressPaterrn::find($id);

        $patient=Patient::find($expres_parent->patient_id);
        $expres =ExpressPaterrn::where('parent_id',$id)->get();


        $for_pdf = true;
        if (is_null($patient) || is_null($expres)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);

        $pdf = PDF::loadView("samples.express_paterrn.show",compact('patient','expres','expres_parent','for_pdf'));


        return $pdf->stream();


    }

}
