<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\AdviceSheetInsurance;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class AdviceSheetInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = AdviceSheetInsurance::where('patient_id',$patient->id)->onlyApproved()->with("department_head")->get();
        return view("samples.advice_sheet_insurance.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 15;
        return view("samples.advice_sheet_insurance.create", compact('patient','repeatables'));
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
           /* 'admission_date' => 'required|nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',*/

        ]);



        $adviceSheet = $patient->advice_sheet_insurance()->create($request->all());
        $adviceSheet->storeSampleDiagnosis($request);
        $adviceSheet->adviceDoctors()->create($request->only('adv'));
       // $adviceSheet->storeDoctor($request);


        return back()->with(['success' => __('samples.created')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\AdviceSheetInsurance  $adviceSheetInsurance
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->advice_sheet_insurance()->findOrFail($id);
        return view("samples.advice_sheet_insurance.show",compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\AdviceSheetInsurance  $adviceSheetInsurance
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->advice_sheet_insurance()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.advice_sheet_insurance.edit")->with(compact('patient', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\AdviceSheetInsurance  $adviceSheetInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
        ]);

        $post = $patient->advice_sheet_insurance()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\AdviceSheetInsurance  $adviceSheetInsurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = AdviceSheetInsurance::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
