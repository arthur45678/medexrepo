<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\BixSterilizationLog;
use App\Models\Samples\ConsciousVoluntaryConsent;
use Illuminate\Http\Request;

class ConsciousVoluntaryConsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = ConsciousVoluntaryConsent::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.conscious_voluntary_consents.index", compact('patient','apse_list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.conscious_voluntary_consents.create", compact('patient'));
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
            'firstName_lastName_patronymic' => 'string',
            'bix_surgery_date' => 'nullable|date|before:tomorrow',
        ]);

        $patient->conscious_voluntary_consents()->create($request->all());

        return response()->json(['success'=>'Բիքսի մանրէազերծման գրանցամատյան ավելացվեց']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\ConsciousVoluntaryConsent  $consciousVoluntaryConsent
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->conscious_voluntary_consents()->findOrFail($id);
        return view("samples.conscious_voluntary_consents.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ConsciousVoluntaryConsent  $consciousVoluntaryConsent
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $consc_id)
    {
        $conscious = $patient->conscious_voluntary_consents()->findOrFail($consc_id);
        $this->authorize("belongs-to-user", $conscious);

        return view("samples.conscious_voluntary_consents.edit")->with(compact('patient', 'conscious'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ConsciousVoluntaryConsent  $consciousVoluntaryConsent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Patient $patient, $conscious_id)
    {
        $conscious = $patient->conscious_voluntary_consents()->findOrFail($conscious_id);

        $this->authorize("belongs-to-user", $conscious);

        $res = $conscious->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ConsciousVoluntaryConsent  $consciousVoluntaryConsent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsciousVoluntaryConsent $consciousVoluntaryConsent)
    {
        //
    }
}
