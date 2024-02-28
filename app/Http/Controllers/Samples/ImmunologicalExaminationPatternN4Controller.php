<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\ImmunologicalExaminationPatternN4;
use App\Models\Stationary;
use Illuminate\Http\Request;

class ImmunologicalExaminationPatternN4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $patient=Patient::find($id);
        $immunologia = $patient->ImmunologicalExaminationPatternN4()->onlyApproved()->get();
        return view("samples.immunological_examination_pattern_n4.index", compact('immunologia','patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {

        $patent = Patient::find($patient_id);
        $amboulator = Ambulator::where('patient_id', $patient_id)->first();
        $stationarie = $patent->stationaries;

        $research = ImmunologicalExaminationPatternN4::get()->count()+1;
        return view("samples.immunological_examination_pattern_n4.create",
            compact('patent', 'amboulator', 'stationarie', 'research'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'hospital_room_number' => 'required',
            'specialist' =>'required|numeric|exists:users,id',
            'date' => 'required|date|before:tomorrow',
        ]);


        $immunologi = ImmunologicalExaminationPatternN4::create($request->all());

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.iep-n4.index', $request->patient_id),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN3  $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id,$id)
    {
        $immunologia = ImmunologicalExaminationPatternN4::where('patient_id',$patent_id)->find($id);
        if ($immunologia==null){
            abort('404');
        }
        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::where('id', $immunologia->ambulator_id)->first();
        $stationarie = Stationary::where('id',$immunologia->stationary_id)->first();

        return view("samples.immunological_examination_pattern_n4.show", compact('immunologia','patent','amboulator','stationarie'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN3  $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {
        $immunologia = ImmunologicalExaminationPatternN4::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);


        if ($immunologia==null){
            abort('404');
        }
        $patent=Patient::find($patent_id);
        $amboulator = Ambulator::where('patient_id', $patent_id)->first();
        $stationarie = $patent->stationaries;
        return view("samples.immunological_examination_pattern_n4.edit", compact('immunologia','patent','amboulator','stationarie'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN3  $immunologicalExaminationPatternN3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $data)
    {
        $request->validate([
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'hospital_room_number' => 'required',
            'specialist' =>'required|numeric|exists:users,id',
            'date' => 'required|date|before:tomorrow',
        ]);

        $immunologi = ImmunologicalExaminationPatternN4::find($request->immunologia);
        $immunologi->update($request->all());


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.iep-n4.index', $request->patient_id),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ImmunologicalExaminationPatternN4  $immunologicalExaminationPatternN4
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $immunologia = ImmunologicalExaminationPatternN4::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_type','App\Models\Samples\ImmunologicalExaminationPatternN4')->where('approvable_id',$id)->delete();

        if ($immunologia==null){
            abort('404');
        }
        $immunologia->delete();
        return back()->with('ok','colums delete');


    }
}
