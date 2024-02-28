<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\ReferralOutpatientExaminations;
use Illuminate\Http\Request;

class ReferralOutpatientExaminationsController extends Controller
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
        return view("samples.refferal_outpatient_examinations.create");
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
     * @param  \App\Models\Samples\ReferralOutpatientExaminations  $referralOutpatientExaminations
     * @return \Illuminate\Http\Response
     */
    public function show($referralOutpatientExaminations)
    {
        return view("samples.refferal_outpatient_examinations.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ReferralOutpatientExaminations  $referralOutpatientExaminations
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferralOutpatientExaminations $referralOutpatientExaminations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ReferralOutpatientExaminations  $referralOutpatientExaminations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReferralOutpatientExaminations $referralOutpatientExaminations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ReferralOutpatientExaminations  $referralOutpatientExaminations
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferralOutpatientExaminations $referralOutpatientExaminations)
    {
        //
    }
}
