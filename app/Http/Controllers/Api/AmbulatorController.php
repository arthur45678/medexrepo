<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PDF;
use App\Models\Ambulator;
use App\Models\Patient;
use App\Models\PatientFirstInfo;
use Illuminate\Support\Facades\DB;

class AmbulatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        $ambulator = Ambulator::where('patient_id', $patient->id)->get();
        return response()->json(['data' => $ambulator], 200, [
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
     * @param  int  $ambulator_id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, $ambulator_id)
    {
        $patient = Patient::find($patient_id);
        $ambulator = Ambulator::where([['id', '=', $ambulator_id], ['patient_id', '=', $patient_id]])->first();

        if (is_null($patient) || is_null($ambulator)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['data' => $ambulator], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function get_ambulator_pdf($patient_id, $ambulator_id)
    {
        $patient = Patient::find($patient_id);
        $ambulator = Ambulator::where([['id', '=', $ambulator_id], ['patient_id', '=', $patient_id]])->first();
        $first_info = PatientFirstInfo::where('patient_id','=',$patient->id)->with('first_clinic_item','first_discovered_item')->get();
        $histological = DB::table('stationary_histological_examinations')->where('stationary_id','=', $patient->id)->get();
        $cellular = DB::table('stationary_cellular_examinations')->where('stationary_id','=', $patient->id)->get();
        $stationaries = DB::table('stationaries')
        ->join('stationary_surgeries', 'stationaries.id', '=', 'stationary_surgeries.stationary_id')
        ->select(
            'stationaries.id as stationary_id',
            'stationaries.admission_date',
            'stationaries.discharge_date',
            'stationaries.number',
            'stationary_surgeries.id as surgery_id',
            'stationary_surgeries.surgery_date'
        )->where('stationaries.patient_id', '=', $patient->id)->get();

        $patient = $patient->with([
            'first_info',
            'harmfuls',
            'cancer_groups',
            'ambulator'
        ])->first();
        $for_pdf = true;

        if (is_null($patient) || is_null($ambulator)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $date = date('Y-m-d', strtotime( $ambulator->registration_date) ) .'_'. date("h-i-s");
        // return view('ambulators.show_page1', compact('patient', 'ambulator'));

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView('ambulators.show_page1', compact('patient', 'ambulator', 'for_pdf', 'stationaries', 'histological', 'first_info', 'cellular'));
        return $pdf->stream();
        // return $pdf->download('ambulator_down_'.$date.'.pdf');
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
