<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\IndividualTreatmentPlan;
use App\Models\Samples\IndividualTreatmentPlansAppointmentsList;
use App\Models\Samples\IndividualTreatmentPlansService;
use App\Models\Samples\IndividualTreatmentPlansTreatmentList;
use Illuminate\Http\Request;

class IndividualTreatmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        $lists=IndividualTreatmentPlan::orderBy('id','desc')->get();
        return view("samples.individual_treatment_plan.index", compact('patient', 'lists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        return view("samples.individual_treatment_plan.create", compact('patient', 'repeatables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'entry_date' => 'required|date|before:tomorrow',
            "doctor_oncologist_id" => 'required|numeric|exists:users,id',
            "surgeon_oncologist_id" => 'required|numeric|exists:users,id',
            "chemotherapist_id" => 'required|numeric|exists:users,id',
            "histologist_id" => 'required|numeric|exists:users,id',
            "radiologist_id" => 'required|numeric|exists:users,id',
            "radiologist_specialist_id" => 'required|numeric|exists:users,id',

        ]);
        $parent_list = IndividualTreatmentPlan::create($request->all());

            IndividualTreatmentPlansService::create([
                "parent_id" => $parent_list->id,
                'service_id' => $request->laboratory_id,
                'type' => 'laboratory',
                'comment' => $request->laboratory_comment,
            ]);


            IndividualTreatmentPlansService::create([
                "parent_id" => $parent_list->id,
                'service_id' => $request->instrumental_id,
                'type' => 'instrumental',
                'comment' => $request->instrumental_comment,
            ]);


            IndividualTreatmentPlansService::create([
                "parent_id" => $parent_list->id,
                'service_id' => $request->radiation_id,
                'type' => 'radiation',
                'comment' => $request->radiation_comment,
            ]);


           IndividualTreatmentPlansService::create([
                "parent_id" => $parent_list->id,
                'service_id' => $request->histological_id,
                'type' => 'histological',
                'comment' => $request->histological_comment,
            ]);


             IndividualTreatmentPlansTreatmentList::create([
                "parent_id" => $parent_list->id,
                'treatment_id' => $request->treatment_chemotherapy_id,
                'type' => 'chemotherapy',
                'treatment_comment' => $request->treatment_chemotherapy_comment,
            ]);

            IndividualTreatmentPlansTreatmentList::create([
                "parent_id" => $parent_list->id,
                'treatment_id' => $request->treatment_radiation_id,
                'type' => 'radiation',
                'treatment_comment' => $request->treatment_radiation_comment,
            ]);

        if ($request->appointments_surgical_id) {
            foreach ($request->appointments_surgical_id as $sk => $surgical) {
                if ($surgical != null) {
                IndividualTreatmentPlansAppointmentsList::create([
                    "parent_id" => $parent_list->id,
                    'medicine_id' => $surgical,
                    'type' => 'surgical',
                    'appointments_comments' => $request->appointments_surgical_comment[$sk],
                ]);
            }
            }
        }
        if ($request->appointments_chemotherapy_id) {
            foreach ($request->appointments_chemotherapy_id as $ck => $chemotherapy) {
                if ($chemotherapy != null) {
           IndividualTreatmentPlansAppointmentsList::create([
                    "parent_id" => $parent_list->id,
                    'medicine_id' => $chemotherapy,
                    'type' => 'chemotherapy',
                    'appointments_comments' => $request->appointments_chemotherapy_comment[$ck],
                ]);
            }
            }
        }
        if ($request->appointments_radiation_id) {
            foreach ($request->appointments_radiation_id as $rk => $radiation) {
                if ($radiation != null) {
                     IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $parent_list->id,
                        'medicine_id' => $radiation,
                        'type' => 'radiation',
                        'appointments_comments' => $request->appointments_radiation_comment[$rk],
                    ]);
                }
            }
        }
        if ($request->appointments_control_id) {
            foreach ($request->appointments_control_id as $controlkey => $control) {
                if ($control != null) {
               IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $parent_list->id,
                        'medicine_id' => $control,
                        'type' => 'control',
                        'appointments_comments' => $request->appointments_control_comment[$controlkey],
                    ]);
                }
            }
        }


        $parent_list->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.individual-treatment-plan.index', $patient),
            'delay' => 2000
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\IndividualTreatmentPlan $individualTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $indivdual_id)
    {

        $indivdual=IndividualTreatmentPlan::find($indivdual_id);
        $indivdual_service_laboratory=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','laboratory')->first();
        $indivdual_service_instrumental=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','instrumental')->first();
        $indivdual_service_radiation=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_service_histological=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','histological')->first();
        $indivdual_treatment_radiation=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_treatment_chemotherapy=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->first();
        $indivdual_appointments_surgical=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','surgical')->get();
        $indivdual_appointments_chemotherapy=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->get();
        $indivdual_appointments_radiation=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','radiation')->get();
        $indivdual_appointments_control=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','control')->get();


        return view("samples.individual_treatment_plan.show",
            compact('patient','indivdual_id','indivdual',
                'indivdual_service_histological','indivdual_service_instrumental','indivdual_service_laboratory','indivdual_service_radiation',
                'indivdual_treatment_chemotherapy','indivdual_treatment_radiation'
                , 'indivdual_appointments_surgical','indivdual_appointments_chemotherapy','indivdual_appointments_radiation','indivdual_appointments_control'
            ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\IndividualTreatmentPlan $individualTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $indivdual_id)
    {

        $repeatables = 5;
        $indivdual=IndividualTreatmentPlan::where('patient_id',$patient->id)
            ->where('user_id',auth()->id())->find($indivdual_id);

        if ($indivdual==null){
            abort('404');
        };
        $indivdual_service_laboratory=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','laboratory')->first();
        $indivdual_service_instrumental=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','instrumental')->first();
        $indivdual_service_radiation=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_service_histological=IndividualTreatmentPlansService::where('parent_id',$indivdual_id)->where('type','histological')->first();
        $indivdual_treatment_radiation=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','radiation')->first();
        $indivdual_treatment_chemotherapy=IndividualTreatmentPlansTreatmentList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->first();
        $indivdual_appointments_surgical=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','surgical')->get();
        $indivdual_appointments_chemotherapy=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','chemotherapy')->get();
        $indivdual_appointments_radiation=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','radiation')->get();
        $indivdual_appointments_control=IndividualTreatmentPlansAppointmentsList::where('parent_id',$indivdual_id)->where('type','control')->get();


        return view("samples.individual_treatment_plan.edit",
            compact('patient', 'repeatables','indivdual_id','indivdual',
            'indivdual_service_histological','indivdual_service_instrumental','indivdual_service_laboratory','indivdual_service_radiation',
        'indivdual_treatment_chemotherapy','indivdual_treatment_radiation'
          , 'indivdual_appointments_surgical','indivdual_appointments_chemotherapy','indivdual_appointments_radiation','indivdual_appointments_control'
            ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\IndividualTreatmentPlan $individualTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient ,$individual_id)
    {

        $request->validate([
            'patient_id' => 'required',
            'department_id' => 'required|numeric|exists:departments,id',
            'entry_date' => 'required|date|before:tomorrow',
            "doctor_oncologist_id" => 'required|numeric|exists:users,id',
            "surgeon_oncologist_id" => 'required|numeric|exists:users,id',
            "chemotherapist_id" => 'required|numeric|exists:users,id',
            "histologist_id" => 'required|numeric|exists:users,id',
            "radiologist_id" => 'required|numeric|exists:users,id',
            "radiologist_specialist_id" => 'required|numeric|exists:users,id',

        ]);
        $individual=IndividualTreatmentPlan::find($individual_id);
        $individual->update($request->all());

        IndividualTreatmentPlansService::where('parent_id',$individual_id)->where('type','laboratory')->update([
            'service_id' => $request->laboratory_id,
            'comment' => $request->laboratory_comment,
        ]);


        IndividualTreatmentPlansService::where('parent_id',$individual_id)->where('type','instrumental')->update([
            'service_id' => $request->instrumental_id,
            'comment' => $request->instrumental_comment,
        ]);


        IndividualTreatmentPlansService::where('parent_id',$individual_id)->where('type','radiation')->update([
            'service_id' => $request->radiation_id,
            'comment' => $request->radiation_comment,
        ]);


        IndividualTreatmentPlansService::where('parent_id',$individual_id)->where('type','histological')->update([
            'service_id' => $request->histological_id,
            'comment' => $request->histological_comment,
        ]);
     IndividualTreatmentPlansTreatmentList::where('parent_id',$individual_id)->where('type','radiation')
         ->update([

             'treatment_id' => $request->treatment_chemotherapy_id,
             'treatment_comment' => $request->treatment_radiation_comment,
        ]);
     IndividualTreatmentPlansTreatmentList::where('parent_id',$individual_id)->where('type','chemotherapy')
         ->update([

             'treatment_id' => $request->treatment_chemotherapy_id,
             'treatment_comment' => $request->treatment_chemotherapy_comment,
        ]);

        if ($request->appointments_surgical_id) {
            foreach ($request->appointments_surgical_id as $sk => $surgical) {
                if ($surgical != null) {
                    IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $individual_id,
                        'medicine_id' => $surgical,
                        'type' => 'surgical',
                        'appointments_comments' => $request->appointments_surgical_comment[$sk],
                    ]);
                }
            }
        }
        if ($request->appointments_chemotherapy_id) {
            foreach ($request->appointments_chemotherapy_id as $ck => $chemotherapy) {
                if ($chemotherapy != null) {
                    IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $individual_id,
                        'medicine_id' => $chemotherapy,
                        'type' => 'chemotherapy',
                        'appointments_comments' => $request->appointments_chemotherapy_comment[$ck],
                    ]);
                }
            }
        }
        if ($request->appointments_radiation_id) {
            foreach ($request->appointments_radiation_id as $rk => $radiation) {
                if ($radiation != null) {
                    IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $individual_id,
                        'medicine_id' => $radiation,
                        'type' => 'radiation',
                        'appointments_comments' => $request->appointments_radiation_comment[$rk],
                    ]);
                }
            }
        }
        if ($request->appointments_control_id) {
            foreach ($request->appointments_control_id as $controlkey => $control) {
                if ($control != null) {
                    IndividualTreatmentPlansAppointmentsList::create([
                        "parent_id" => $individual_id,
                        'medicine_id' => $control,
                        'type' => 'control',
                        'appointments_comments' => $request->appointments_control_comment[$controlkey],
                    ]);
                }
            }
        }
        $approvement = $individual->approvement()->firstOrNew([
            "approvable_id" =>$individual_id,
            "approvable_type" => get_class($individual)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.individual-treatment-plan.index', $patient),
            'delay' => 2000
        ], 200);

    }
    public function trash($data)
    {
        IndividualTreatmentPlansAppointmentsList::find($data)->delete();
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\IndividualTreatmentPlan $individualTreatmentPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        // App\Models\Samples\IndividualTreatmentPlan
        $individualTreatmentPlan = IndividualTreatmentPlan::where('patient_id',$patent_id)
            ->where('user_id',auth()->id())->find($id);
        IndividualTreatmentPlansService::where('parent_id',$id)->delete();
        IndividualTreatmentPlansAppointmentsList::where('parent_id',$id)->delete();
        IndividualTreatmentPlansTreatmentList::where('parent_id',$id)->delete();

        if ($individualTreatmentPlan==null){
            abort('404');
        }
        $approvement=Approvement::where('approvable_type','App\Models\Samples\IndividualTreatmentPlan')
            ->where('approvable_id',$id)->delete();

        $individualTreatmentPlan->delete();
        return back()->with('ok','colums delete');



    }
}
