<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Chamber;
use Illuminate\Http\Request;

class ChamberListController extends Controller
{

    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function chambers_json(Request $request, Chamber $chamber)
    {
        return response()->json($chamber->search($request->q ?? ""));
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
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function show(Chamber $chamber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function edit(Chamber $chamber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chamber $chamber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chamber $chamber)
    {
        //
    }
}
