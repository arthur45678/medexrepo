<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\MedicineList;
use Illuminate\Http\Request;

class MedicineListController extends Controller
{
    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function medicines_json(Request $request, MedicineList $medicineList)
    {
        return response()->json($medicineList->search($request->q ?? ""));
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
     * @param  \App\Models\MedicineList  $medicineList
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineList $medicineList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicineList  $medicineList
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineList $medicineList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicineList  $medicineList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineList $medicineList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicineList  $medicineList
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineList $medicineList)
    {
        //
    }
}
