<?php

namespace App\Http\Controllers\Samples;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\Echocardiogram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EchocardiogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = Echocardiogram::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.echocardiogram.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.echocardiogram.create", compact('patient'));
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
            'patient_age' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $patient->echo_cardiograms()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->echo_cardiograms()->findOrFail($id);
        return view("samples.echocardiogram.show",compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->echo_cardiograms()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $post);

        return view("samples.echocardiogram.edit")->with(compact('patient', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'patient_age' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $post = $patient->echo_cardiograms()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = Echocardiogram::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}


