<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\ErythrocyteMorphology;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\ErythrocyteMorphologyRequest;
use App\Models\Approvement;

class ErythrocyteMorphologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $em_list = $patient->erythrocyte_morphologies()->onlyApproved()->with("attending_doctor")->get();
        // dd($em_list);

        return view("samples.erythrocyte_morphology.index")->with(compact("em_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.erythrocyte_morphology.create")->with(compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Samples\ErythrocyteMorphologyRequest
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(ErythrocyteMorphologyRequest $request, Patient $patient)
    {
        $patient->erythrocyte_morphologies()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\ErythrocyteMorphology  $erythrocyteMorphology
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $em_id)
    {
        // dd(erythrocyte_morphologies()->get());
        $em = $patient->erythrocyte_morphologies()->onlyApproved()->findOrFail($em_id);

        return view("samples.erythrocyte_morphology.show")->with(compact('patient', 'em'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\ErythrocyteMorphology  $erythrocyteMorphology
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $em_id)
    {
        $em = $patient->erythrocyte_morphologies()->findOrFail($em_id);
        $this->authorize("belongs-to-user", $em);

        return view("samples.erythrocyte_morphology.edit")->with(compact('patient', 'em'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Samples\ErythrocyteMorphology  $erythrocyteMorphology
     * @param  \App\Models\Patient  $patient
     * @param  int $um_id
     * @return \Illuminate\Http\Response
     */
    public function update(ErythrocyteMorphologyRequest $request,Patient $patient, ErythrocyteMorphology $em)
    {
        $em= $patient->erythrocyte_morphologies()->findOrFail($em_id);
        $this->authorize("belongs-to-user", $em);

        $em->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ErythrocyteMorphology  $erythrocyteMorphology
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $erytrocyte = ErythrocyteMorphology::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($erytrocyte==null){
            abort('404');
        }
        $erytrocyte->delete();
        return back()->with('ok','colums delete');
    }
}
