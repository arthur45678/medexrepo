<?php

namespace App\Http\Controllers\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\HistologicalExamination;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Approvement;

class HistologicalExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = HistologicalExamination::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.histological_examination.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $data_limit = 10;
        return view("samples.histological_examination.create", compact('patient', 'repeatables','data_limit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {

        $request->validate([
        //    'admission_date' => 'nullable|date|before:tomorrow',
        ]);

         $histologyExam =  $patient->histological_examinations()->create($request->all());

         $histologyExam->storeClinicalDiagnoses($request);
         $histologyExam->storeHistologicalSummaryDiagnosis($request);

         return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\HistologicalExamination  $histologicalExamination
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->histological_examinations()->findOrFail($id);
        return view("samples.histological_examination.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\HistologicalExamination  $histologicalExamination
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $repeatables = 25;
        $data_limit = 10;
        $post = $patient->histological_examinations()->findOrFail($post_id);

        $user = auth()->user()->getSamplesRelations([
            "histological_clinical_diagnosis",
            "histological_summary_diagnosis",
        ], $post_id);

        $this->authorize("belongs-to-user", $post);
        return view("samples.histological_examination.edit",compact('patient','repeatables','post','data_limit','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\HistologicalExamination  $histologicalExamination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $post = $patient->histological_examinations()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }


    public function diagnoses(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_diagnoses,id",
            "diagnosis_comment" => "nullable|string|max:10000",
            "diagnosis_date" => "nullable|date|before:tomorrow",
            "disease_id" => "nullable|numeric|exists:disease_lists,id",
        ]);

        $diagnosis = SampleDiagnose::findOrFail($request->id);
        $this->authorize("belongs-to-user", $diagnosis);

        $diagnosis->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\HistologicalExamination  $histologicalExamination
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $histological_examination = HistologicalExamination::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($histological_examination==null){
            abort('404');
        }
        $histological_examination->delete();
        return back()->with('ok','colums delete');
    }
}
