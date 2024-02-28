<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PersonalTreatmentMedication;
use App\Models\Samples\PersonalTreatmentPlan;
use Illuminate\Http\Request;

class PersonalTreatmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patent_id)
    {

        $patent = Patient::find($patent_id);
        $plan=$patent->personalTreatmentPlan()->onlyApproved()->get();

        return view("samples.personal_treatment_plan.index", compact('patent','plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patent_id)
    {
        $repeatables=4;
        $patent = Patient::find($patent_id);
        return view("samples.personal_treatment_plan.create", compact('patent','repeatables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $treatment_id = PersonalTreatmentPlan::create($request->all());
        if ($request['medicines_surgery']) {
            foreach ($request['medicines_surgery'] as $k => $surgery) {

                if ($surgery != null):
                    PersonalTreatmentMedication::create([
                        'treatment_id' => $treatment_id->id,
                        'medicine_id' => $request['medicines_surgery'][$k],
                        'type' => 'surgery',
                        'comment' => $request['medicines_surgery_comment'][$k],
                    ]);
                endif;
            }

        }
        if ($request['medicines_chemotherapy']) {
            foreach ($request['medicines_chemotherapy'] as $k => $chemotherapy) {

                if ($chemotherapy != null):
                PersonalTreatmentMedication::create([
                    'treatment_id' => $treatment_id->id,
                    'medicine_id' => $request['medicines_chemotherapy'][$k],
                    'type' => 'chemotherapy',
                    'comment' => $request['medicines_chemotherapy_comment'][$k],
                ]);
                endif;
            }
        }
        if ($request['medicines_radiation']) {
            foreach ($request['medicines_radiation'] as $k => $radiation) {

                if ($radiation != null):
                PersonalTreatmentMedication::create([
                    'treatment_id' => $treatment_id->id,
                    'medicine_id' => $request['medicines_radiation'][$k],
                    'type' => 'radiation',
                    'comment' => $request['medicines_radiation_comment'][$k],
                ]);
                endif;
            }
        }
        if ($request['medicines_diagnostic']) {
            foreach ($request['medicines_diagnostic'] as $k => $diagnostic) {

                if ($diagnostic != null):
                PersonalTreatmentMedication::create([
                    'treatment_id' => $treatment_id->id,
                    'medicine_id' => $request['medicines_diagnostic'][$k],
                    'type' => 'diagnostic',
                    'comment' => $request['medicines_diagnostic_comment'][$k],
                ]);
                endif;
            }
        }

        return redirect()->route('samples.patients.personal-treatment-plan.show', [$request->patient_id , $treatment_id->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\PersonalTreatmentPlan $personalTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id, $id)
    {
        $plan=PersonalTreatmentPlan::find($id);
        $patent = Patient::find($plan->patient_id);
        $surgery=PersonalTreatmentMedication::with(['medicine_name'])->where('type','surgery')->where('treatment_id',$id)->get();
        $chemotherapy=PersonalTreatmentMedication::with(['medicine_name'])->where('type','chemotherapy')->where('treatment_id',$id)->get();
        $radiation=PersonalTreatmentMedication::with(['medicine_name'])->where('type','radiation')->where('treatment_id',$id)->get();
        $diagnostic=PersonalTreatmentMedication::with(['medicine_name'])->where('type','diagnostic')->where('treatment_id',$id)->get();

        return view("samples.personal_treatment_plan.show",
            compact('plan','patent','surgery','chemotherapy','radiation','diagnostic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\PersonalTreatmentPlan $personalTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {

        $repeatables=4;
        $plan=PersonalTreatmentPlan::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($plan==null){
            abort('404');
        };

        $patent = Patient::find($plan->patient_id);

        $surgery=PersonalTreatmentMedication::with(['medicine_name'])->where('type','surgery')->where('treatment_id',$id)->get();
        $chemotherapy=PersonalTreatmentMedication::with(['medicine_name'])->where('type','chemotherapy')->where('treatment_id',$id)->get();
        $radiation=PersonalTreatmentMedication::with(['medicine_name'])->where('type','radiation')->where('treatment_id',$id)->get();
        $diagnostic=PersonalTreatmentMedication::with(['medicine_name'])->where('type','diagnostic')->where('treatment_id',$id)->get();

        return view("samples.personal_treatment_plan.edit", compact('patent','plan','surgery','repeatables','chemotherapy','radiation','diagnostic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\PersonalTreatmentPlan $personalTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $treatment_id = PersonalTreatmentPlan::find($id);
        $treatment_id->update($request->all());

        if ($request['medicines_surgery']) {
            foreach ($request['medicines_surgery'] as $k => $surgery) {

                if ($surgery != null):
                    PersonalTreatmentMedication::create([
                        'treatment_id' => $id,
                        'medicine_id' => $request['medicines_surgery'][$k],
                        'type' => 'surgery',
                        'comment' => $request['medicines_surgery_comment'][$k],
                    ]);
                endif;
            }

        }
        if ($request['medicines_chemotherapy']) {
            foreach ($request['medicines_chemotherapy'] as $k => $chemotherapy) {

                if ($chemotherapy != null):
                    PersonalTreatmentMedication::create([
                        'treatment_id' => $id,
                        'medicine_id' => $request['medicines_chemotherapy'][$k],
                        'type' => 'chemotherapy',
                        'comment' => $request['medicines_chemotherapy_comment'][$k],
                    ]);
                endif;
            }
        }
        if ($request['medicines_radiation']) {
            foreach ($request['medicines_radiation'] as $k => $radiation) {

                if ($radiation != null):
                    PersonalTreatmentMedication::create([
                        'treatment_id' => $id,
                        'medicine_id' => $request['medicines_radiation'][$k],
                        'type' => 'radiation',
                        'comment' => $request['medicines_radiation_comment'][$k],
                    ]);
                endif;
            }
        }
        if ($request['medicines_diagnostic']) {
            foreach ($request['medicines_diagnostic'] as $k => $diagnostic) {

                if ($diagnostic != null):
                    PersonalTreatmentMedication::create([
                        'treatment_id' => $id,
                        'medicine_id' => $request['medicines_diagnostic'][$k],
                        'type' => 'diagnostic',
                        'comment' => $request['medicines_diagnostic_comment'][$k],
                    ]);
                endif;
            }
        }
        return redirect()->route('samples.patients.personal-treatment-plan.show', [$request->patient_id , $id]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\PersonalTreatmentPlan $personalTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function trash($data)
    {

        $medication=PersonalTreatmentMedication::find($data)->delete();

        return $data;

    }
    public function destroy($patent_id,$id)
    {
        $pers = PersonalTreatmentPlan::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_type','App\Models\Samples\PersonalTreatmentPlan')->where('approvable_id',$id)->delete();


        if ($pers==null){
            abort('404');
        };
       $med= PersonalTreatmentMedication::where('treatment_id',$id)->get();

       if (count($med)>0){

           $med= PersonalTreatmentMedication::where('treatment_id',$id)->delete();
       }
        $pers->delete();
        return back()->with('ok','colums delete');


    }
}
