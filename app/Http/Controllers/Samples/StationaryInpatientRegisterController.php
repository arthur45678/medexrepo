<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\StationaryInpatientDiagnosis;
use App\Models\Samples\StationaryInpatientRegister;
use App\Models\Stationary;
use App\Models\TreatmentList;
use App\Models\TumorTreatmentList;
use Illuminate\Http\Request;

class StationaryInpatientRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {


        $patient = Patient::find($id);
        $inpatient = $patient->StationaryInpatientRegisters()->onlyApproved()->get();
        return view("samples.stationary_inpatient_register.index", compact('patient', 'inpatient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patent_id)
    {
        $repeatables = 5;
        $patent = Patient::find($patent_id);
        $research = rand(1000, 9000000);
        $stationarie = $patent->stationaries;
        return view("samples.stationary_inpatient_register.create", compact('research', 'patent', 'stationarie','repeatables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creatde = StationaryInpatientRegister::create($request->all());
        if ($request->enter_id) {
            foreach ($request['enter_id'] as $enter => $enter_id) {
                if ($enter_id != null):
                    $prescraption = StationaryInpatientDiagnosis::create([

                        'inpatient_id' => $creatde->id,
                        'disease_id' => $enter_id,
                        'type' =>'enter',
                        'diagnosis_comment' => $request['enter_comment'][$enter],

                    ]);

                endif;
            }
        }
        if ($request->exit_id) {
            foreach ($request['exit_id'] as $exit => $exit_id) {
                if ($exit_id != null):
                    $prescraption = StationaryInpatientDiagnosis::create([
                        'inpatient_id' => $creatde->id,
                        'disease_id' => $exit_id,
                        'type' =>'exit',
                        'diagnosis_comment' => $request['exit_comment'][$exit],

                    ]);

                endif;
            }


        }
        return redirect()->route('samples.patients.stationary-inpatient-register.show', [$request->patient_id , $creatde->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\StationaryInpatientRegister $stationaryInpatientRegister
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id,$id)
    {
        $inpatient = StationaryInpatientRegister::with(['Tumorlists'])->find($id);
        $inpatient_diagnos = StationaryInpatientDiagnosis::where('inpatient_id',$id)->get();
        $patent = Patient::find($patent_id);
        $tumorlists=TreatmentList::where('id',$inpatient->treatment_id)->first();

        return view("samples.stationary_inpatient_register.show", compact( 'patent','inpatient_diagnos','inpatient','tumorlists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\StationaryInpatientRegister $stationaryInpatientRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {
        $repeatables = 5;
        $inpatient = StationaryInpatientRegister::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($inpatient==null){
            abort('404');
        }
        $inpatient_diagnos_enter = StationaryInpatientDiagnosis::where('inpatient_id',$id)->where('type','enter')->get();
        $inpatient_diagnos_exit= StationaryInpatientDiagnosis::where('inpatient_id',$id)->where('type','exit')->get();
        $patent = Patient::find($patent_id);
        $stationarie = Stationary::find($inpatient->stationary_id);
        return view("samples.stationary_inpatient_register.edit", compact( 'patent',  'stationarie','inpatient','repeatables','inpatient_diagnos_enter','inpatient_diagnos_exit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\StationaryInpatientRegister $stationaryInpatientRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$patient_id)
    {

        $creatde = StationaryInpatientRegister::find($id);
        $creatde->update($request->all());

        if ($request->enter_id) {
            foreach ($request['enter_id'] as $enter => $enter_id) {
                if ($enter_id != null):
                    $prescraption = StationaryInpatientDiagnosis::create([

                        'inpatient_id' => $creatde->id,
                        'disease_id' => $enter_id,
                        'type' =>'enter',
                        'diagnosis_comment' => $request['enter_comment'][$enter],

                    ]);

                endif;
            }
        }
        if ($request->exit_id) {
            foreach ($request['exit_id'] as $exit => $exit_id) {
                if ($exit_id != null):
                    $prescraption = StationaryInpatientDiagnosis::create([
                        'inpatient_id' => $creatde->id,
                        'disease_id' => $exit_id,
                        'type' =>'exit',
                        'diagnosis_comment' => $request['exit_comment'][$exit],

                    ]);

                endif;
            }


        }
        return redirect()->route('samples.patients.stationary-inpatient-register.show', [$patient_id , $id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\StationaryInpatientRegister $stationaryInpatientRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $inputReg= StationaryInpatientRegister::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement = Approvement::where('approvable_type','App\Models\Samples\StationaryInpatientRegister')->where('approvable_id', $id)->delete();

        if ($inputReg==null){
            abort('404');
        }
        $Diagnostic = StationaryInpatientDiagnosis::where('inpatient_id',$id)->get();
        if ($Diagnostic->count()>0){
             StationaryInpatientDiagnosis::where('inpatient_id',$id)->delete();
        }
        $inputReg->delete();
        return back()->with('ok','colums delete');


    }
    public function trash($data)
    {
        StationaryInpatientDiagnosis::find($data)->delete();
        return $data;
    }
}
