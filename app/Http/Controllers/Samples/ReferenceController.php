<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\Reference;
use App\Models\Patient;
use App\Http\Requests\Samples\ReferenceRequest;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $ref_list = $patient->references()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.reference.index")->with(compact("ref_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.reference.create")->with(compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\ReferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReferenceRequest $request, Patient $patient)
    {
        $patient->references()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }


    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $ref_id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Samples\Reference  $reference
    */

    public function show(Patient $patient, $ref_id)
    {
        $ref = $patient->references()->onlyApproved()->findOrFail($ref_id);
        return view("samples.reference.show")->with(compact('patient', 'ref'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient  $patient
     * @param  int  $ref_id
     * @param  \App\Models\Samples\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $ref_id)
    {
        $ref = $patient->references()->findOrFail($ref_id);
        $this->authorize("belongs-to-user", $ref);

        return view("samples.reference.edit")->with(compact('patient', 'ref'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ReferenceRequest  $request
     * @param  \App\Models\Samples\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(ReferenceRequest $request, Patient $patient, Reference $ref)
    {
        $ref = $patient->references()->findOrFail($ref_id);
        $this->authorize("belongs-to-user", $ref);

        $ref->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reference $ref)
    {
        //
    }
}
