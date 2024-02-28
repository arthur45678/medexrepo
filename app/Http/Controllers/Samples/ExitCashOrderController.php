<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\ExitCashOrder;
use Illuminate\Http\Request;

class ExitCashOrderController extends Controller
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
        return view("samples.exit_cash_order.create");
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
     * @param  \App\Models\Samples\ExitCashOrder  $exitCashOrder
     * @return \Illuminate\Http\Response
     */
    public function show( $exitCashOrder)
    {
        return view("samples.exit_cash_order.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ExitCashOrder  $exitCashOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ExitCashOrder $exitCashOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ExitCashOrder  $exitCashOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExitCashOrder $exitCashOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ExitCashOrder  $exitCashOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExitCashOrder $exitCashOrder)
    {
        //
    }
}
