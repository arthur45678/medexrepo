<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;
use App\Models\Samples\StationaryDischargeCard;
use App\Models\Samples\StationaryDischargeCardsDiagnosis;

use Illuminate\Http\Request;
class StationaryDischargeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        $apse_list = $patient->StationaryDischargeCard()->onlyApproved()->get();
        return view("samples.stationary_discharge_card.index")->with(compact("apse_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $stationaries= $patient->stationaries()->orderBy('id','desc')->first();
        if(!$stationaries)
            abort(403,$patient->full_name . __("stationary.does_not_have_card") );
        $departmentauth=Department::find(auth()->user()->department_id);

        return view("samples.stationary_discharge_card.create")->with(compact("repeatables",'patient','departmentauth','stationaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Patient $patient)
    {
        $request->validate([
            'research_date' => 'nullable|date|before:tomorrow',
            'date_discharge_or_death' => 'nullable|date|before:tomorrow',
            'RW_date' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

   $parent=StationaryDischargeCard::create($request->all());

        $parent->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);
        if ($request->first_diagnosis_a) {
            foreach ($request['first_diagnosis_a'] as $a => $enter_a) {
                if ($enter_a != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'aa',
                        'disease_id' => $enter_a,
                        'diagnoses_comments' => $request['first_diagnosis_comment_a'][$a],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_b) {
            foreach ($request['first_diagnosis_b'] as $b => $enter_b) {
                if ($enter_b != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ab',
                        'disease_id' => $enter_b,
                        'diagnoses_comments' => $request['first_diagnosis_comment_b'][$b],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_c) {
            foreach ($request['first_diagnosis_c'] as $c => $enter_c) {
                if ($enter_c != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ac',
                        'disease_id' => $enter_c,
                        'diagnoses_comments' => $request['first_diagnosis_comment_c'][$c],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_ba) {
            foreach ($request['first_diagnosis_ba'] as $ba => $enter_ba) {
                if ($enter_ba != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ba',
                        'disease_id' => $enter_ba,
                        'diagnoses_comments' => $request['first_diagnosis_comment_ba'][$ba],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_bb) {
            foreach ($request['first_diagnosis_bb'] as $bb => $enter_bb) {
                if ($enter_bb != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'bb',
                        'disease_id' => $enter_bb,
                        'diagnoses_comments' => $request['first_diagnosis_comment_bb'][$bb],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_bc) {
            foreach ($request['first_diagnosis_bc'] as $bc => $enter_bc) {
                if ($enter_bc != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'bc',
                        'disease_id' => $enter_bc,
                        'diagnoses_comments' => $request['first_diagnosis_comment_bc'][$bc],
                    ]);

                endif;
            }
        }
        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.stationary-discharge-card.index', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\StationaryDischargeCard  $stationaryDischargeCard
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $apse_id)
    {

        $repeatables = 5;
        $departmentauth=Department::find(auth()->user()->department_id);

        $descharge=StationaryDischargeCard::where('patient_id',$patient->id)->where('id',$apse_id)->first();;

//        $diagnostic_aa=StationaryDischargeCardsDiagnosis::where('type','aa')->where('parent_id',$descharge->id)->get();
//        $diagnostic_ab=StationaryDischargeCardsDiagnosis::where('type','ab')->where('parent_id',$descharge->id)->get();
//        $diagnostic_ac=StationaryDischargeCardsDiagnosis::where('type','ac')->where('parent_id',$descharge->id)->get();
//        $diagnostic_ba=StationaryDischargeCardsDiagnosis::where('type','ba')->where('parent_id',$descharge->id)->get();
//        $diagnostic_bb=StationaryDischargeCardsDiagnosis::where('type','bb')->where('parent_id',$descharge->id)->get();
//        $diagnostic_bc=StationaryDischargeCardsDiagnosis::where('type','bc')->where('parent_id',$descharge->id)->get();

        $stationaries= $patient->stationaries()->find($descharge->stationary_id);

        return view("samples.stationary_discharge_card.show")->with(compact("repeatables",'patient',
            'departmentauth','descharge','apse_id','stationaries'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\StationaryDischargeCard  $stationaryDischargeCard
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $apse_id)
    {

        $repeatables = 5;
        $departmentauth=Department::find(auth()->user()->department_id);

        $descharge=StationaryDischargeCard::where('patient_id',$patient->id)->where('user_id',auth()->id())->where('id',$apse_id)->first();;
        if ($descharge==null){
            abort('404');
        }
        $diagnostic_aa=StationaryDischargeCardsDiagnosis::where('type','aa')->where('parent_id',$descharge->id)->get();
        $diagnostic_ab=StationaryDischargeCardsDiagnosis::where('type','ab')->where('parent_id',$descharge->id)->get();
        $diagnostic_ac=StationaryDischargeCardsDiagnosis::where('type','ac')->where('parent_id',$descharge->id)->get();
        $diagnostic_ba=StationaryDischargeCardsDiagnosis::where('type','ba')->where('parent_id',$descharge->id)->get();
        $diagnostic_bb=StationaryDischargeCardsDiagnosis::where('type','bb')->where('parent_id',$descharge->id)->get();
        $diagnostic_bc=StationaryDischargeCardsDiagnosis::where('type','bc')->where('parent_id',$descharge->id)->get();
        return view("samples.stationary_discharge_card.edit")->with(compact("repeatables",'patient',
            'departmentauth','descharge','apse_id','diagnostic_aa','diagnostic_ab','diagnostic_ac','diagnostic_ba','diagnostic_bb','diagnostic_bc'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\StationaryDischargeCard  $stationaryDischargeCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $apse_id)
    {
        $request->validate([
            'research_date' => 'nullable|date|before:tomorrow',
            'date_discharge_or_death' => 'nullable|date|before:tomorrow',
            'RW_date' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);
        $parent=StationaryDischargeCard::find($apse_id);
        $parent->update($request->all());

        $approvement = $parent->approvement()->firstOrNew([
            "approvable_id" => $apse_id,
            "approvable_type" => get_class($parent)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        if ($request->first_diagnosis_a) {
            foreach ($request['first_diagnosis_a'] as $a => $enter_a) {
                if ($enter_a != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'aa',
                        'disease_id' => $enter_a,
                        'diagnoses_comments' => $request['first_diagnosis_comment_a'][$a],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_b) {
            foreach ($request['first_diagnosis_b'] as $b => $enter_b) {
                if ($enter_b != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ab',
                        'disease_id' => $enter_b,
                        'diagnoses_comments' => $request['first_diagnosis_comment_b'][$b],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_c) {
            foreach ($request['first_diagnosis_c'] as $c => $enter_c) {
                if ($enter_c != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ac',
                        'disease_id' => $enter_c,
                        'diagnoses_comments' => $request['first_diagnosis_comment_c'][$c],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_ba) {
            foreach ($request['first_diagnosis_ba'] as $ba => $enter_ba) {
                if ($enter_ba != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'ba',
                        'disease_id' => $enter_ba,
                        'diagnoses_comments' => $request['first_diagnosis_comment_ba'][$ba],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_bb) {
            foreach ($request['first_diagnosis_bb'] as $bb => $enter_bb) {
                if ($enter_bb != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'bb',
                        'disease_id' => $enter_bb,
                        'diagnoses_comments' => $request['first_diagnosis_comment_bb'][$bb],
                    ]);

                endif;
            }
        }
        if ($request->first_diagnosis_bc) {
            foreach ($request['first_diagnosis_bc'] as $bc => $enter_bc) {
                if ($enter_bc != null):
                    StationaryDischargeCardsDiagnosis::create([
                        'parent_id' => $parent->id,
                        'type' => 'bc',
                        'disease_id' => $enter_bc,
                        'diagnoses_comments' => $request['first_diagnosis_comment_bc'][$bc],
                    ]);

                endif;
            }
        }
        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.stationary-discharge-card.index', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\StationaryDischargeCard  $stationaryDischargeCard
     * @return \Illuminate\Http\Response
     */
    public function trash($data)
    {
        StationaryDischargeCardsDiagnosis::find($data)->delete();
        return $data;
    }
    public function destroy(Patient $patient, $apse_id)
    {
        $descharge=StationaryDischargeCard::where('patient_id',$patient->id)
            ->where('user_id',auth()->id())->where('id',$apse_id)->first();;

        if ($descharge==null){
            abort('404');
        }
        $descharge->delete();
        $approvement=Approvement::where('approvable_type','App\Models\Samples\StationaryDischargeCard')->where('approvable_id',$apse_id)->delete();
        return back();
    }
}
