<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\ClinicalLabN2;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;
use App\Models\Stationary;

class ClinicalLabN2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $stationary_id
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $cl_list = $patient->clinical_labs_n2()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.clinical_lab_n2.index")->with(compact("cl_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $ambulator = $patient->ambulator;
        if(!$ambulator)
            abort(403,$patient->full_name .'-ը դեռ չունի ամբուլատոոր քարտ։');
        $ambulator_id = optional($patient->ambulator)->number;
        $stationaries = $patient->stationarie;
        if(!$stationaries)
            abort(403,$patient->full_name . __("stationary.does_not_have_card") );
        $all_stationary_id = $patient->stationaries->pluck('number');
        # next_bbe_number
        $clinical_labs_n2_s_latest = ClinicalLabN2::latest()->first();
        $last_bbe_number = $clinical_labs_n2_s_latest->bbe_number ?? 0;
        $next_bbe_number = $last_bbe_number + 1;

        return view("samples.clinical_lab_n2.create")->with(compact(
                'patient',
                'all_stationary_id',
                'ambulator_id',
                'next_bbe_number',
            ));

    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([

            'bbe_number' => 'required|numeric',
            'biopsy_date' => 'required|date|before:tomorrow',

            'department_id' => 'required|numeric|exists:departments,id',
            'chamber' => 'nullable|numeric|exists:chambers,id',
            'sender_doctor_id' => 'required|numeric|exists:users,id',

            // 'stationary_id' => 'required|numeric|numeric|exists:stationaries,id',
            // 'glucose' => 'nullable|numeric',
            // 'urine' => 'nullable|numeric',
            // 'prothrombin' => 'nullable|numeric',
            // 'amylase' => 'nullable|numeric',
            // 'uroamylase' => 'nullable|numeric',

            'research_date' => 'required|date',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $patient->clinical_labs_n2()->create($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.clinical-lab-n2.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $bl_id
     * @param  \App\Models\Samples\BiochemicalLabN9  $cl
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $cl_id)
    {
        $ambulator_id = $patient->ambulator->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $cl = $patient->clinical_labs_n2()->onlyApproved()->findOrFail($cl_id);
        // dd($hr);
        return view("samples.clinical_lab_n2.show")->with(compact('patient', 'cl', 'ambulator_id', 'all_stationary_id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\ClinicalLabN2  $bl
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $cl_id)
    {
        $ambulator_id = $patient->ambulator->number;
        $all_stationary_id = $patient->stationaries->pluck('number');

        $cl = $patient->clinical_labs_n2()->findOrFail($cl_id);
        $this->authorize("belongs-to-user", $cl);

        return view("samples.clinical_lab_n2.edit")->with(compact('patient', 'cl', 'ambulator_id', 'all_stationary_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ClinicalLabN2  $cl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $cl_id)
    {
        $cl= $patient->clinical_labs_n2()->findOrFail($cl_id);
        $this->authorize("belongs-to-user", $cl);

        $cl->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ClinicalLabN2  $cl
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $clinical_lab = ClinicalLabN2::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($clinical_lab==null){
            abort('404');
        }
        $clinical_lab->delete();
        return back()->with('ok','colums delete');
    }
}
