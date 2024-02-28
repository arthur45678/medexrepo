<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\AnesthesiologDiagnosis;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;

// use App\Enums\Samples\SampleTreatmentsEnum;
// use App\Enums\StationaryAgeTypeEnum;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
use App\Models\Patient;
use App\Models\Stationary;
use Illuminate\Http\Request;
use App\Models\Approvement;

class AnesthesiologistPreSurgeryExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

       $apse_list = $patient->AnesthesiologistPreSurgeryExamination()->onlyApproved()->get();
        return view("samples.anesthesiology.index")->with(compact("apse_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {

        $repeatables = 5;


        $lates_stationary = $patient->stationaries()->latest()->first();
        return view("samples.anesthesiology.create")->with(compact('patient', 'lates_stationary', 'repeatables'));

        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Models\Patient $patient
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, Patient $patient)
    {

        $request->validate([
            'date' => 'required|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $anesthesiolog = AnesthesiologistPreSurgeryExamination::create($request->all());
        $anesthesiolog->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);
        if ($request->first_diagnosis_a) {
            foreach ($request['first_diagnosis_a'] as $a => $enter_a) {
                if ($enter_a != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'a',
                        'disease_id' => $enter_a,
                        'surgeries_comment' => $request['first_diagnosis_comment_a'][$a],
                    ]);

                endif;
            }
        }
        if ($request->diagnosis_b) {
            foreach ($request['diagnosis_b'] as $b => $enter_b) {
                if ($enter_b != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'b',
                        'disease_id' => $enter_b,
                        'surgeries_comment' => $request['diagnosis_comment_b'][$b],
                    ]);
                endif;
            }
        }
        if ($request->treatment_c) {
            foreach ($request['treatment_c'] as $c => $enter_c) {
                if ($enter_c != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'c',
                        'treatment_id' => $enter_c,
                        'surgeries_comment' => $request['diagnosis_comment_b'][$c],
                    ]);
                endif;
            }
        }
        if ($request->suffering_diseases_d) {
            foreach ($request['suffering_diseases_d'] as $d => $enter_d) {
                if ($enter_d != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'd',
                        'disease_id' => $enter_d,
                        'surgeries_comment' => $request['suffering_diseases_comment_d'][$d],
                    ]);
                endif;
            }
        }

        if ($request->harmful_diseases_id_e) {
            foreach ($request['harmful_diseases_id_e'] as $e => $enter_e) {
                if ($enter_e != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'e',
                        'disease_id' => $enter_e,
                        'surgeries_comment' => $request['harmful_diseases_comment_e'][$e],
                    ]);
                endif;
            }
        }

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.ape.index', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Patient $patient
     * @param int $apse_id
     * @param \App\Models\Samples\AnesthesiologistPreSurgeryExamination $apse
     * @return \Illuminate\Http\Response
     */

    public function show(Patient $patient, Stationary $stationary, $apse_id)
    {

        // dd($stationary->stationary_diagnoses);


        // dd($apse->sample_surgeries->toArray());
        // dd($apse->sample_surgeries->first()->surgery->toArray());

        $lates_stationary = $patient->stationaries()->latest()->first();

        $apse = AnesthesiologistPreSurgeryExamination::find($apse_id);
        $anestologia_a = AnesthesiologDiagnosis::where('type', 'a')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_b = AnesthesiologDiagnosis::where('type', 'b')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_c = AnesthesiologDiagnosis::where('type', 'c')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_d = AnesthesiologDiagnosis::where('type', 'd')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_e = AnesthesiologDiagnosis::where('type', 'e')->where('anesthesiolog_id', $apse_id)->get();

        return view("samples.anesthesiology.show")
            ->with(compact('patient', 'apse', 'lates_stationary','lates_stationary',
                'anestologia_a','anestologia_b','anestologia_c','anestologia_d','anestologia_e'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Patient $patient
     * @param int $apse_id
     * @param \App\Models\Samples\AnesthesiologistPreSurgeryExamination $apse
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $apse_id)
    {
        $repeatables = 5;

        $lates_stationary = $patient->stationaries()->latest()->first();
        $apse =AnesthesiologistPreSurgeryExamination::where('patient_id',$patient->id)->where('user_id',auth()->id())->where('id',$apse_id)->first();
        if ($apse==null){
            abort('404');
        }
        $this->authorize("belongs-to-user", $apse);
        $anestologia_a = AnesthesiologDiagnosis::where('type', 'a')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_b = AnesthesiologDiagnosis::where('type', 'b')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_c = AnesthesiologDiagnosis::where('type', 'c')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_d = AnesthesiologDiagnosis::where('type', 'd')->where('anesthesiolog_id', $apse_id)->get();
        $anestologia_e = AnesthesiologDiagnosis::where('type', 'e')->where('anesthesiolog_id', $apse_id)->get();
        return view("samples.anesthesiology.edit")
            ->with(compact('patient', 'apse', 'lates_stationary',
                'repeatables','anestologia_a','anestologia_b','anestologia_c','anestologia_d','anestologia_e'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\AnesthesiologistPreSurgeryExamination $apse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $apse_id)
    {
        $request->validate([
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);
        $anesthesiolog =AnesthesiologistPreSurgeryExamination::find($apse_id);

        $approvement = $anesthesiolog->approvement()->firstOrNew([
            "approvable_id" => $anesthesiolog->id,
            "approvable_type" => get_class($anesthesiolog)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        $anesthesiolog->update($request->all());
        if ($request->first_diagnosis_a) {
            foreach ($request['first_diagnosis_a'] as $a => $enter_a) {
                if ($enter_a != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'a',
                        'disease_id' => $enter_a,
                        'surgeries_comment' => $request['first_diagnosis_comment_a'][$a],
                    ]);

                endif;
            }
        }
        if ($request->diagnosis_b) {
            foreach ($request['diagnosis_b'] as $b => $enter_b) {
                if ($enter_b != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'b',
                        'disease_id' => $enter_b,
                        'surgeries_comment' => $request['diagnosis_comment_b'][$b],
                    ]);
                endif;
            }
        }
        if ($request->treatment_c) {
            foreach ($request['treatment_c'] as $c => $enter_c) {
                if ($enter_c != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'c',
                        'treatment_id' => $enter_c,
                        'surgeries_comment' => $request['treatment_comment_c'][$c],
                    ]);
                endif;
            }
        }
        if ($request->suffering_diseases_d) {
            foreach ($request['suffering_diseases_d'] as $d => $enter_d) {
                if ($enter_d != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'd',
                        'disease_id' => $enter_d,
                        'surgeries_comment' => $request['suffering_diseases_comment_d'][$d],
                    ]);
                endif;
            }
        }

        if ($request->harmful_diseases_id_e) {
            foreach ($request['harmful_diseases_id_e'] as $e => $enter_e) {
                if ($enter_e != null):
                    AnesthesiologDiagnosis::create([
                        'anesthesiolog_id' => $anesthesiolog->id,
                        'type' => 'e',
                        'disease_id' => $enter_e,
                        'surgeries_comment' => $request['harmful_diseases_comment_e'][$e],
                    ]);
                endif;
            }
        }

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.ape.index', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\AnesthesiologistPreSurgeryExamination $anesthesiologistPreSurgeryExamination
     * @return \Illuminate\Http\Response
     */
    public function trash($data)
    {
        AnesthesiologDiagnosis::find($data)->delete();
        return $data;
    }
    public function destroy(Patient $patient, $apse_id )
    {
        $apse =AnesthesiologistPreSurgeryExamination::where('patient_id',$patient->id)
            ->where('user_id',auth()->id())->where('id',$apse_id)->first();
        if ($apse==null){
            abort('404');
        }
        AnesthesiologDiagnosis::where('anesthesiolog_id', $apse_id)->delete();
        $apse->delete();
        $approvement=Approvement::where('approvable_type','App\Models\Samples\AnesthesiologistPreSurgeryExamination')->where('approvable_id',$apse_id)->delete();
        return back();
    }
}
