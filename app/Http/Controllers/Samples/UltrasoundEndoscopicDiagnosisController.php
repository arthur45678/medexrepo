<?php

namespace App\Http\Controllers\Samples;
use App\Http\Controllers\Controller;
use App\Models\Samples\UltrasoundEndoscopicDiagnosis;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Approvement;

class UltrasoundEndoscopicDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        dd(1);
        return view("samples.ultrasound_endoscopic_diagnosis.create")->with(compact('patient'));
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
     * @param  \App\Models\Samples\UltrasoundEndoscopicDiagnosis  $ultrasoundEndoscopicDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(UltrasoundEndoscopicDiagnosis $ultrasoundEndoscopicDiagnosis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\UltrasoundEndoscopicDiagnosis  $ultrasoundEndoscopicDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(UltrasoundEndoscopicDiagnosis $ultrasoundEndoscopicDiagnosis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\UltrasoundEndoscopicDiagnosis  $ultrasoundEndoscopicDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UltrasoundEndoscopicDiagnosis $ultrasoundEndoscopicDiagnosis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\UltrasoundEndoscopicDiagnosis  $ultrasoundEndoscopicDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(UltrasoundEndoscopicDiagnosis $ultrasoundEndoscopicDiagnosis)
    {
        //
    }
}
