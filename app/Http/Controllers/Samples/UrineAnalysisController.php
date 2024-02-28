<?php

namespace App\Http\Controllers\Samples;
use App\Http\Controllers\Controller;
use App\Models\Samples\UrineAnalysis;
use Illuminate\Http\Request;

class UrineAnalysisController extends Controller
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
    public function create()
    {
        return view("samples.urine_analysis.create");
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
     * @param  \App\Models\Samples\UrineAnalysis  $urineAnalysis
     * @return \Illuminate\Http\Response
     */
    public function show( $urineAnalysis)
    {
        return view("samples.urine_analysis.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\UrineAnalysis  $urineAnalysis
     * @return \Illuminate\Http\Response
     */
    public function edit(UrineAnalysis $urineAnalysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\UrineAnalysis  $urineAnalysis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UrineAnalysis $urineAnalysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\UrineAnalysis  $urineAnalysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrineAnalysis $urineAnalysis)
    {
        //
    }
}
