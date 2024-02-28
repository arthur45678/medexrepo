<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StationarySocialPackage;
use Illuminate\Http\Request;

use PDF;
use App\Models\Patient;
use App\Models\Stationary;

class StationaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $patient_id
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient = Patient::find($patient_id);
        if (is_null($patient)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $patientStationaries = $patient->stationaries;
        return response()->json(['data' => $patientStationaries], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $patient_id
     * @param  int  $stationary_id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, $stationary_id)
    {
        $patient = Patient::find($patient_id);
        $stationary = Stationary::where([['id', '=', $stationary_id], ['patient_id', '=', $patient_id]])->first();

        if (is_null($patient) || is_null($stationary)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['data' => $stationary], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function get_stationary_pdf($patient_id, $stationary_id)
    {
        $patient = Patient::find($patient_id);
        $stationary = Stationary::where([['id', '=', $stationary_id], ['patient_id', '=', $patient_id]])->first();
        $for_pdf = true;
        $stationary_social_packages = StationarySocialPackage::where('id','=', $patient->id)->with('package_item')->get();

        // return view('stationary.show_page1', compact('patient', 'stationary'));
        if (is_null($patient) || is_null($stationary)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $date = date('Y-m-d_H-i-s', strtotime( $stationary->admission_date) );
        // return response()->json(['date' => $date], 200);

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView('stationary.show_page1', compact('patient', 'stationary', 'for_pdf', 'stationary_social_packages'));
        return $pdf->stream();
        // return $pdf->download('stationary_down_'.$date.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
