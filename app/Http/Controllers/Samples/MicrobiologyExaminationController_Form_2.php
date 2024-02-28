<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Samples\MicrobiologyExamination_Form_2;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class MicrobiologyExaminationController_Form_2 extends Controller
{
    protected $table = 'microbiology_examinations_form_2';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = MicrobiologyExamination_Form_2::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.microbiology_examination_form_2.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $amboulator = Ambulator::where('patient_id', $patient->id)->get();
        $stationarie = $patient->stationaries;
        return view("samples.microbiology_examination_form_2.create", compact('patient','amboulator', 'stationarie'));
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
            'admission_date' => 'nullable|date|before:tomorrow',
            'medical_company_name' => 'required',
        ]);


        $patient->microbiology_examination_form_2()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->microbiology_examination_form_2()->findOrFail($id);
        return view('samples.microbiology_examination_form_2.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->microbiology_examination_form_2()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.microbiology_examination_form_2.edit")->with(compact('patient', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'medical_company_name' => 'required',
        ]);

        $post = $patient->microbiology_examination_form_2()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = $patient->microbiology_examination_form_2()->findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
