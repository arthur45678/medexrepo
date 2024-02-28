<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\DrugDestructionAct;
use App\Models\Samples\Echocardiogram;
use Illuminate\Http\Request;


class DrugDestructionActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = DrugDestructionAct::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.drug_destruction_act.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {

        return view("samples.drug_destruction_act.create",compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
        ]);

        $patient->drug_destruction_act()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\DrugDestructionAct  $drugDestructionAct
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->drug_destruction_act()->findOrFail($id);
        return view("samples.drug_destruction_act.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\DrugDestructionAct  $drugDestructionAct
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->drug_destruction_act()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);
        return view("samples.drug_destruction_act.edit")->with(compact('patient', 'post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\DrugDestructionAct  $drugDestructionAct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
        ]);

        $post = $patient->drug_destruction_act()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());
        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\DrugDestructionAct  $drugDestructionAct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugDestructionAct $drugDestructionAct)
    {
        //
    }
}
