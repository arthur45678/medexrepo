<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
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
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = $patient->anesthesiology_presurgery_examinations()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.anesthesiology.index")->with(compact("apse_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
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
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([

            'first_diagnosis' => 'nullable|string',
            'concomitant_disease' => 'nullable|string',
            'currently_receiving_treatment' => 'nullable|string',
            'suffering_diseases' => 'nullable|string',
            'harmful_diseases' => 'nullable|string',
            'harmful_diseases' => 'nullable|string',
            'date' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',

        ]);

        $patient->anesthesiology_presurgery_examinations()->create($request->all());
        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.ape.create', $patient),
            'delay' => 2000
        ], 201);


        $examination = $patient->anesthesiology_presurgery_examinations()->create($request->all());


        $first_diagnosis = array($request->disease_id, 0, $request->first_diagnosis_length);
        if (count(array_filter($first_diagnosis))) {

            foreach ($first_diagnosis as $key => $value) {
                if ($value) {
                    $examination->sample_diagnoses()->create([
                        "diagnosable_type" => SampleDiagnosesEnum::first_diagnosis(),
                        'disease_id' => $value,
                        'diagnosis_comment' => $request->first_diagnosis_comment[$key]
                    ]);
                }
            }
        }

        $concomitant_disease = array($request->disease_id, 0, $request->diagnosis_length);
        if (count(array_filter($concomitant_disease))) {

            foreach ($concomitant_disease as $key => $value) {
                if ($value) {
                    $examination->sample_diagnoses()->create([
                        "diagnosis_type" => SampleDiagnosesEnum::concomitant_disease(),
                        'disease_id' => $value,
                        'diagnosis_comment' => $request->diagnosis_comment
                    ]);
                }
            }
        }


        $currently_receiving_treatment = array($request->treatment_id, 0, $request->treatment_length);
        if (count(array_filter($currently_receiving_treatment))) {

            foreach ($currently_receiving_treatment as $key => $value) {
                if ($value) {
                    $examination->sample_treatments()->create([
                        "treatments_type" => SampleTreatmentsEnum::currently_receiving_treatment(),
                        'treatment_id' => $value,
                        'treatment_comment' => $request->treatment_comment
                    ]);
                }
            }
        }


        $suffering_diseases = array($request->disease_id, 0, $request->suffering_diseases_length);
        if (count(array_filter($suffering_diseases))) {

            foreach ($suffering_diseases as $key => $value) {
                if ($value) {
                    $examination->sample_diagnoses()->create([
                        "diagnosis_type" => SampleDiagnosesEnum::suffering_diseases(),
                        'disease_id' => $value,
                        'diagnosis_comment' => $request->suffering_diseases_comment
                    ]);
                }
            }
        }



        $harmful_diseases = array($request->disease_id, 0, $request->harmful_diseases_length);
        if (count(array_filter($harmful_diseases))) {

            foreach ($harmful_diseases as $key => $value) {
                if ($value) {
                    $examination->sample_diagnoses()->create([
                        "diagnosis_type" => SampleDiagnosesEnum::harmful_diseases(),
                        'disease_id' => $value,
                        'diagnosis_comment' => $request->harmful_diseases_comment
                    ]);
                }
            }
        }



        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $apse_id
     * @param  \App\Models\Samples\AnesthesiologistPreSurgeryExamination  $apse
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Stationary $stationary, $apse_id)
    {
        // dd($stationary->stationary_diagnoses);
        $lates_stationary = $patient->stationaries()->latest()->first();

        $apse = $patient->anesthesiology_presurgery_examinations()->onlyApproved()->findOrFail($apse_id);
        // dd($apse->sample_surgeries->toArray());
        // dd($apse->sample_surgeries->first()->surgery->toArray());
        return view("samples.anesthesiology.show")->with(compact('patient', 'apse', 'lates_stationary', 'stationary'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient  $patient
     * @param  int  $apse_id
     * @param  \App\Models\Samples\AnesthesiologistPreSurgeryExamination  $apse
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $apse_id)
    {
        $repeatables = 5;

        $lates_stationary = $patient->stationaries()->latest()->first();
        $apse = $patient->anesthesiology_presurgery_examinations()->findOrFail($apse_id);
        $this->authorize("belongs-to-user", $apse);

        return view("samples.anesthesiology.edit")->with(compact('patient', 'apse', 'lates_stationary', 'repeatables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\AnesthesiologistPreSurgeryExamination  $apse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Patient $patient, $apse_id)
    {
        $apse = $patient->anesthesiology_presurgery_examinations()->findOrFail($apse_id);
        $this->authorize("belongs-to-user", $apse);

        $apse->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\AnesthesiologistPreSurgeryExamination  $anesthesiologistPreSurgeryExamination
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnesthesiologistPreSurgeryExamination $anesthesiologistPreSurgeryExamination)
    {
        //
    }
}
