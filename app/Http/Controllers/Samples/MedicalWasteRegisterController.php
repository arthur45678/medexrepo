<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\MedicalWasteRegister;
use Illuminate\Http\Request;
use App\Models\Patient;

class MedicalWasteRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = MedicalWasteRegister::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.medical_waste_register.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.medical_waste_register.create",compact('patient'));
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
            'date_of_registration' => 'nullable|date|before:tomorrow',
            'responsible_for_waste_doctor_id' => 'nullable|numeric',
            'waste_handler_doctor_id' => 'nullable|numeric',
            'receiver_waste_doctor_id' => 'nullable|numeric',
        ]);

        $patient->medical_waste_register()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalWasteRegister  $medicalWasteRegister
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->medical_waste_register()->findOrFail($id);
        return view("samples.medical_waste_register.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalWasteRegister  $medicalWasteRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->medical_waste_register()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.medical_waste_register.edit")->with(compact('patient', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalWasteRegister  $medicalWasteRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'date_of_registration' => 'nullable|date|before:tomorrow',
            'responsible_for_waste_doctor_id' => 'nullable|numeric',
            'waste_handler_doctor_id' => 'nullable|numeric',
            'receiver_waste_doctor_id' => 'nullable|numeric',
        ]);

        $post = $patient->medical_waste_register()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);
        $res = $post->update($request->all());
        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalWasteRegister  $medicalWasteRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalWasteRegister $medicalWasteRegister)
    {
        //
    }
}
