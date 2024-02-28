<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\DiseaseList;
use Illuminate\Http\Request;

class DiseaseListController extends Controller
{

    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function diseases_json(Request $request, DiseaseList $diseaseList)
    {
        return response()->json($diseaseList->search($request->q ?? ""));
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
     * @param  \App\Models\DiseaseList  $diseaseList
     * @return \Illuminate\Http\Response
     */
    public function show(DiseaseList $diseaseList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiseaseList  $diseaseList
     * @return \Illuminate\Http\Response
     */
    public function edit(DiseaseList $diseaseList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiseaseList  $diseaseList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiseaseList $diseaseList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiseaseList  $diseaseList
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiseaseList $diseaseList)
    {
        //
    }
}
