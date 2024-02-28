<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\ImmunologicalExaminationPatternN2;
use Illuminate\Http\Request;


class ImmunologicalExaminationPatternN2Controller extends Controller
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
        return view("samples.immunological_examination_pattern_n2.create");
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
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN2  $immunologicalExaminationPatternN2
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view("samples.immunological_examination_pattern_n2.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN2  $immunologicalExaminationPatternN2
     * @return \Illuminate\Http\Response
     */
    public function edit(ImmunologicalExaminationPatternN2 $immunologicalExaminationPatternN2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN2  $immunologicalExaminationPatternN2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImmunologicalExaminationPatternN2 $immunologicalExaminationPatternN2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN2  $immunologicalExaminationPatternN2
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImmunologicalExaminationPatternN2 $immunologicalExaminationPatternN2)
    {
        //
    }
}
