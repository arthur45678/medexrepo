<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\HospitalizationReferral;
use App\Models\Patient;
use App\Http\Requests\Samples\HospitalizationReferralRequest;
use App\Models\Approvement;

class HospitalizationReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $hr_list = $patient->hospitalization_referrales()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.hospitalization_referral.index")->with(compact("hr_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.hospitalization_referral.create")->with(compact('patient'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Samples\HospitalizationReferral
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalizationReferralRequest $request, Patient $patient)
    {
        $patient->hospitalization_referrales()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */

     /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\HospitalizationReferral  $hospitalizationReferral
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $hr_id)
    {

        $hr = $patient->hospitalization_referrales()->onlyApproved()->findOrFail($hr_id);
        // dd($hr);
        return view("samples.hospitalization_referral.show")->with(compact('patient', 'hr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\HospitalizationReferral  $hospitalizationReferral
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $hr_id)
    {
        $hr = $patient->hospitalization_referrales()->findOrFail($hr_id);
        $this->authorize("belongs-to-user", $hr);

        return view("samples.hospitalization_referral.edit")->with(compact('patient', 'hr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\HospitalizationReferral  $hospitalizationReferral
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalizationReferralRequest $request, Patient $patient, HospitalizationReferral $hr)
    {
        $hr= $patient->hospitalization_referrales()->findOrFail($hr_id);
        $this->authorize("belongs-to-user", $hr);

        $hr->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\HospitalizationReferral  $hospitalizationReferral
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $hospitalization_referral = HistologicalExamination::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($hospitalization_referral==null){
            abort('404');
        }
        $hospitalization_referral->delete();
        return back()->with('ok','colums delete');
    }
}
