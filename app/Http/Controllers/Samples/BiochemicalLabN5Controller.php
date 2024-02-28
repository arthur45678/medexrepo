<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\BiochemicalLabN5;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;

class BiochemicalLabN5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $bl_list = $patient->biochemical_labs_n5()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.biochemical_lab_n5.index")->with(compact("bl_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id =  optional($patient->stationaries)->pluck('number');

        # next_bbe_number
        $biochemical_lab_n5_s_latest = BiochemicalLabN5::latest()->first();
        $last_bbe_number = $biochemical_lab_n5_s_latest->bbe_number ?? 0;
        $next_bbe_number = $last_bbe_number + 1;

        return view("samples.biochemical_lab_n5.create")->with(compact(
            'patient',
            'all_stationary_id',
            'ambulator_id',
            'next_bbe_number'
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

        $patient->biochemical_labs_n5()->create($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.biochemical-lab-n5.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $bl_id
     * @param  \App\Models\Samples\BiochemicalLabN5  $bl
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $bl_id)
    {
        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id =  optional($patient->stationaries)->pluck('number');

        $bl = $patient->biochemical_labs_n5()->onlyApproved()->findOrFail($bl_id);
        // dd($hr);
        return view("samples.biochemical_lab_n5.show")->with(compact('patient', 'bl', 'ambulator_id', 'all_stationary_id'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\BiochemicalLabN5  $bl
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $bl_id)
    {

        $ambulator_id = optional($patient->ambulator)->number;
        $all_stationary_id =  optional($patient->stationaries)->pluck('number');

        $bl = $patient->biochemical_labs_n5()->findOrFail($bl_id);
        $this->authorize("belongs-to-user", $bl);

        return view("samples.biochemical_lab_n5.edit")->with(compact('patient', 'bl', 'ambulator_id', 'all_stationary_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\BiochemicalLabN5  $bl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient,  $bl_id)
    {
        $bl = $patient->biochemical_labs_n5()->findOrFail($bl_id);
        $this->authorize("belongs-to-user", $bl);

        $bl->update($request->all());

        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.biochemical-lab-n5.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\BiochemicalLabN5 $biochemicalLabN5
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $biochemical_lab = BiochemicalLabN5::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($biochemical_lab==null){
            abort('404');
        }
        $biochemical_lab->delete();
        return back()->with('ok','colums delete');
    }
}
