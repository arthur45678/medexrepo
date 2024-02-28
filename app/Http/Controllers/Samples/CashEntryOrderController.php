<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\CashEntryOrder;
use Illuminate\Http\Request;

class CashEntryOrderController extends Controller
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
        return view("samples.cash_entry_order.create");
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
     * @param  \App\Models\Samples\CashEntryOrder  $cashEntryOrder
     * @return \Illuminate\Http\Response
     */
    public function show( $cashEntryOrder)
    {
        return view("samples.cash_entry_order.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\CashEntryOrder  $cashEntryOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(CashEntryOrder $cashEntryOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\CashEntryOrder  $cashEntryOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashEntryOrder $cashEntryOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\CashEntryOrder  $cashEntryOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashEntryOrder $cashEntryOrder)
    {
        //
    }
}
