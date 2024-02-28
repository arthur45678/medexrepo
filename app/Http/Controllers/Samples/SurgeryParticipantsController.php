<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\SurgeryParticipants;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class SurgeryParticipantsController extends Controller
{
    public function index(Patient $patient)
    {
        $apse_list = SurgeryParticipants::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.surgery_participants.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.surgery_participants.create", compact('patient'));
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
          /*  'admission_date' => 'nullable|date|before:tomorrow',
            'patient_age' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',*/
        ]);

        $patient->surgery_participants()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\SurgeryParticipants  $SurgeryParticipants
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->surgery_participants()->findOrFail($id);
        return view("samples.surgery_participants.show",compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\SurgeryParticipants  $SurgeryParticipants
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->surgery_participants()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.surgery_participants.edit")->with(compact('patient', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\SurgeryParticipants  $SurgeryParticipants
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
           /* 'admission_date' => 'nullable|date|before:tomorrow',
            'patient_age' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',*/
        ]);

        $post = $patient->surgery_participants()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\SurgeryParticipants  $SurgeryParticipants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = SurgeryParticipants::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
