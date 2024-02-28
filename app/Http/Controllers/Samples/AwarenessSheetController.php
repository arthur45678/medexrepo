<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\AwarenessSheet;
use App\Models\Patient;
use App\Http\Requests\Samples\AwarenessSheetRequest;


class AwarenessSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $as_list = $patient->awareness_sheets()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.awareness_sheet.index")->with(compact("as_list", "patient"));
    }


    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.awareness_sheet.create")->with(compact('patient'));
    }

    /**
    * Store a newly created resource in storage.
    * @param  \App\Models\Patient $patient
    * @param  \Illuminate\Http\AwarenessSheetRequest  $request
    * @return \Illuminate\Http\Response
    */
    
    public function store(AwarenessSheetRequest $request, Patient $patient )
    {
        $patient->awareness_sheets()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
    * Display the specified resource.
    * @param  \App\Models\Patient $patient
    * @param  int  $as_id
    * @param  \App\Models\Samples\AwarenessSheet  $as
     * @return \Illuminate\Http\Response
    */
    public function show(Patient $patient, $as_id)
    {
        $as = $patient->awareness_sheets()->onlyApproved()->findOrFail($as_id);
        return view("samples.awareness_sheet.show")->with(compact('patient', 'as'));
    }

    /**
    * Show the form for editing the specified resource.
     * @param  \App\Models\Patient  $patient
     * @param  int  $as_id
     * @param  \App\Models\Samples\AwarenessSheet  $as
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $as_id)
    {
        $as = $patient->awareness_sheets()->findOrFail($as_id);
        $this->authorize("belongs-to-user", $as);

        return view("samples.awareness_sheet.edit")->with(compact('patient', 'as'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AwarenessSheetRequest   $request
     * @param  \App\Models\Samples\AwarenessSheet  $as
     * @return \Illuminate\Http\Response
     */
    public function update(AwarenessSheetRequest $request, Patient $patient, AwarenessSheet $as)
    {
        $as = $patient->awareness_sheets()->findOrFail($as_id);
        $this->authorize("belongs-to-user", $as);

        $as->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\AwarenessSheet  $as
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwarenessSheet $as)
    {
        //
    }
}
