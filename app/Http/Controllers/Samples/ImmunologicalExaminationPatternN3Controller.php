<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Approvement;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Samples\ImmunologicalExaminationPatternN3;
use App\Models\Stationary;
use Illuminate\Http\Request;

class ImmunologicalExaminationPatternN3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $patient=Patient::find($id);
        $immunologia = $patient->ImmunologicalExaminationPatternN3()->onlyApproved()->get();


        return view("samples.immunological_examination_pattern_n3.index", compact('immunologia','patient'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {

        $patent = Patient::find($patient_id);
        $departament=Department::find(auth()->user()->department_id);
        $amboulator = Ambulator::where('patient_id', $patient_id)->first();
        $stationarie = $patent->stationaries;

        $research = ImmunologicalExaminationPatternN3::get()->count()+1;

        return view("samples.immunological_examination_pattern_n3.create", compact('departament','patent', 'amboulator', 'stationarie', 'research'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $data)
    {
        $request->validate([
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'hospital_room_number' => 'required',
            'specialist' =>'required|numeric|exists:users,id',
            'date' => 'required|date|before:tomorrow',
        ]);

        $immunologi = ImmunologicalExaminationPatternN3::create($request->all());


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.iep-n3.index', $request->patient_id),
            'delay' => 2000
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\ImmunologicalExaminationPatternN3 $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id,$id)
    {

        $immunologia = ImmunologicalExaminationPatternN3::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            abort('404');
        }
        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::find($immunologia->ambulator_id);
        $stationarie = Stationary::find($immunologia->stationary_id);


        return view("samples.immunological_examination_pattern_n3.show", compact('immunologia','patent','amboulator','stationarie'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\ImmunologicalExaminationPatternN3 $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {
        $immunologia = ImmunologicalExaminationPatternN3::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($immunologia==null){
            abort('404');
        }
        $patent=Patient::find($immunologia->patient_id);
        $departament=Department::find(auth()->user()->department_id);
        $amboulator = Ambulator::where('patient_id', $patent_id)->first();
        $stationarie = $patent->stationaries;
        return view("samples.immunological_examination_pattern_n3.edit", compact('departament','immunologia','patent','amboulator','stationarie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\ImmunologicalExaminationPatternN3 $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $data)
    {
        $v = $this->validate($request, [
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'hospital_room_number' => 'required',
            'specialist' =>'required|numeric|exists:users,id',
            'date' => 'required|date|before:tomorrow',
        ]);

        $immunologi = ImmunologicalExaminationPatternN3::find($request->immunologia);
        $immunologi->update($request->all());

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.iep-n3.index', $request->patient_id),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\ImmunologicalExaminationPatternN3 $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $immunologia = ImmunologicalExaminationPatternN3::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_type','App\Models\Samples\ImmunologicalExaminationPatternN3')->where('approvable_id',$id)->delete();

        if ($immunologia==null){
            abort('404');
        }
        $immunologia->delete();
        return back()->with('ok','colums delete');


    }
}
