<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\TumorTreatmentList;
use Illuminate\Http\Request;

class TumorTreatmentListController extends Controller
{

    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function tumor_treatments_json(Request $request, TumorTreatmentList $tumorTreatmentList)
    {
        return response()->json($tumorTreatmentList->search($request->q ?? ""));
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
     * @param  \App\Models\TumorTreatmentList  $tumorTreatmentList
     * @return \Illuminate\Http\Response
     */
    public function show(TumorTreatmentList $tumorTreatmentList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TumorTreatmentList  $tumorTreatmentList
     * @return \Illuminate\Http\Response
     */
    public function edit(TumorTreatmentList $tumorTreatmentList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TumorTreatmentList  $tumorTreatmentList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TumorTreatmentList $tumorTreatmentList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TumorTreatmentList  $tumorTreatmentList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TumorTreatmentList $tumorTreatmentList)
    {
        //
    }
}
