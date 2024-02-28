<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Samples\MicrobiologyExamination;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class MicrobiologyExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = MicrobiologyExamination::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.microbiology_examination.index", compact('patient','apse_list'));
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
        return view("samples.microbiology_examination.create", compact('patient','amboulator', 'stationarie',));
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
         //   'admission_date' => 'nullable|date|before:tomorrow',
            'medical_company_name' => 'required',
        ]);


        $patient->microbiology_examination()->create($request->all());
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
        $post = $patient->microbiology_examination()->findOrFail($id);
        return view('samples.microbiology_examination.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->microbiology_examination()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.microbiology_examination.edit")->with(compact('patient', 'post'));
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
       //     'admission_date' => 'nullable|date|before:tomorrow',
            'medical_company_name' => 'required',
        ]);

        $post = $patient->microbiology_examination()->findOrFail($post_id);

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
        $post = $patient->microbiology_examination()->findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
