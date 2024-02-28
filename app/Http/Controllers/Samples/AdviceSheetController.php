<?php

namespace App\Http\Controllers\Samples;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Http\Controllers\Controller;
use App\Models\Samples\AdviceSheet;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class AdviceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        //$apse_list = AdviceSheet::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor_id")->get();
        $apse_list = AdviceSheet::where('patient_id',$patient->id)->get();

        return view("samples.advice_sheet.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 15;
        return view("samples.advice_sheet.create", compact('patient','repeatables'));
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
            'admission_date' => 'required|nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $advice_sheet = $patient->advice_sheet()->create($request->all());

        $advice_sheet->storeSampleDiagSamplesMedicinelistnosis($request);
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\AdviceSheet  $adviceSheet
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->advice_sheet()->findOrFail($id);

        $samplesDiagnosis = SampleDiagnose::where(['card_id' => $post->id,
            'diagnosable_type' => SampleDiagnosesEnum::advice_sheet_diagnosis()])->get();
        return view("samples.advice_sheet.show",compact('post','samplesDiagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\AdviceSheet  $adviceSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->advice_sheet()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);


        $samplesDiagnosis = SampleDiagnose::where(['card_id' => $post_id,
            'diagnosable_type' => SampleDiagnosesEnum::advice_sheet_diagnosis()])->get();


      /*  $user = auth()->user()->getSamplesRelations([
            "advice_sheet_diagnosis",
        ], $post_id);*/
        $data_limit = 10;
        $repeatables = 5;
        return view("samples.advice_sheet.edit")->with(compact('patient', 'post','samplesDiagnosis','repeatables','data_limit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\AdviceSheet  $adviceSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
          //  'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $post = $patient->advice_sheet()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());
        $post->storeSampleDiagSamplesMedicinelistnosis($request);

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\AdviceSheet  $adviceSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = AdviceSheet::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
