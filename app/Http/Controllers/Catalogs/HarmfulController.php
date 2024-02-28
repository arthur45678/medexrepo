<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Harmful;
use Illuminate\Http\Request;

class HarmfulController extends Controller
{
    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function harmfuls_json(Request $request, Harmful $harmful)
    {
        return response()->json($harmful->search($request->q ?? ""));
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
     * @param  \App\Models\Harmful  $harmful
     * @return \Illuminate\Http\Response
     */
    public function show(Harmful $harmful)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Harmful  $harmful
     * @return \Illuminate\Http\Response
     */
    public function edit(Harmful $harmful)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Harmful  $harmful
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harmful $harmful)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Harmful  $harmful
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harmful $harmful)
    {
        //
    }
}
