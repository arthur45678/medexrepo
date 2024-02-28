<?php

namespace App\Http\Controllers\Samples;
use App\Http\Controllers\Controller;
use App\Models\Samples\Epicrise;
use Illuminate\Http\Request;

class EpicriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('samples.epicrise.create');
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
     * @param  \App\Models\Samples\Epicrise  $epicrise
     * @return \Illuminate\Http\Response
     */
    public function show( $epicrise)
    {
        return view('samples.epicrise.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\Epicrise  $epicrise
     * @return \Illuminate\Http\Response
     */
    public function edit(Epicrise $epicrise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\Epicrise  $epicrise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Epicrise $epicrise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Epicrise  $epicrise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Epicrise $epicrise)
    {
        //
    }
}
