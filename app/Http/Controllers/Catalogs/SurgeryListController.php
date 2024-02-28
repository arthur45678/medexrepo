<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\SurgeryList;
use Illuminate\Http\Request;

class SurgeryListController extends Controller
{

    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function surgeries_json(Request $request, SurgeryList $surgeryList)
    {
        return response()->json($surgeryList->search($request->q ?? ""));
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
     * @param  \App\Models\SurgeryList  $surgeryList
     * @return \Illuminate\Http\Response
     */
    public function show(SurgeryList $surgeryList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurgeryList  $surgeryList
     * @return \Illuminate\Http\Response
     */
    public function edit(SurgeryList $surgeryList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SurgeryList  $surgeryList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurgeryList $surgeryList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SurgeryList  $surgeryList
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurgeryList $surgeryList)
    {
        //
    }
}
