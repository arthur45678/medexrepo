<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\TreatmentList;
use Illuminate\Http\Request;

class TreatmentListController extends Controller
{
    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function treatments_json(Request $request, TreatmentList $treatmentList)
    {
        return response()->json($treatmentList->search($request->q ?? ""));
    }

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
        //
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
     * @param  \App\Models\TreatmentList  $treatmentList
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentList $treatmentList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreatmentList  $treatmentList
     * @return \Illuminate\Http\Response
     */
    public function edit(TreatmentList $treatmentList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreatmentList  $treatmentList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TreatmentList $treatmentList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentList  $treatmentList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentList $treatmentList)
    {
        //
    }
}
