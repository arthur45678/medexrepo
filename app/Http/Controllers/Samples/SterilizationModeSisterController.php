<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\SterilizationModeSister;
use App\Models\Patient;
use App\Models\Approvement;
use Illuminate\Http\Request;

class SterilizationModeSisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $steril_list = $patient->sterilization_mode_sisters()->onlyApproved()->get();
        return view("samples.sterilization_mode_sister.index")->with(compact("steril_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.sterilization_mode_sister.create")->with(compact('patient',));
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
            'main_date' => 'required',
            'attending_doctor_id' => 'required',
        ]);

        $patient->sterilization_mode_sisters()->create($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.sterilization-mode-sister.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\SterilizationModeSister  $sterilizationModeSister
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $steril_id)
    {
        $steril = $patient->sterilization_mode_sisters()->onlyApproved()->findOrFail($steril_id);
     
        return view("samples.sterilization_mode_sister.show")->with(compact('patient', 'steril'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\SterilizationModeSister  $steril
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $steril_id)
    {
        $steril = $patient->sterilization_mode_sisters()->findOrFail($steril_id);
        $this->authorize("belongs-to-user", $steril);

        return view("samples.sterilization_mode_sister.edit")->with(compact('patient', 'steril'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\SterilizationModeSister  $steril
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $steril_id)
    {
        $steril = $patient->sterilization_mode_sisters()->findOrFail($steril_id);
        $this->authorize("belongs-to-user", $steril);

        $steril->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\SterilizationModeSister  $sterilizationModeSister
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $steril_mode = SterilizationModeSister::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($steril_mode==null){
            abort('404');
        }
        $steril_mode->delete();
        return back()->with('ok','colums delete');
    }
}
