<?php

namespace App\Http\Controllers;

use App\Models\Approvement;
use Illuminate\Http\Request;

class ApprovementController extends Controller
{
    /**
     * Update status column of the specified row
     *
     * @param  \App\Models\Approvement  $approvement
     * @return \Illuminate\Http\Response
     */
    public function updateApprovementStatus(Approvement $approvement)
    {
        $this->authorize("user-can-approve", $approvement->approvable);

        $approvement->update(["status" => true, "approved_by" => auth()->id()]);

        return back()->withSuccess("Կարգավիճակը թարմացվել է");
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
     * @param  \App\Models\Approvement  $approvement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvement $approvement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvement  $approvement
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvement $approvement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approvement  $approvement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvement $approvement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvement  $approvement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvement $approvement)
    {
        //
    }
}
