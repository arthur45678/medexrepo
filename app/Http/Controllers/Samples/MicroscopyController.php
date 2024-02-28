<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\Microscopy;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;

class MicroscopyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $mic_list = $patient->microscopies()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.microscopy.index")->with(compact("mic_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *  @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.microscopy.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $patient->microscopies()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $mic_id
     * @param  \App\Models\Samples\Microscopy  $microscopy
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $mic_id)
    {
        $mic = $patient->microscopies()->onlyApproved()->findOrFail($mic_id);
        return view("samples.microscopy.show")->with(compact('patient','mic'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient  $patient
     * @param  int  $ref_id
     * @param  \App\Models\Samples\Microscopy  $microscopy
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $mic_id)
    {
        $mic = $patient->microscopies()->findOrFail($mic_id);
        $this->authorize("belongs-to-user", $mic);

        return view("samples.microscopy.edit")->with(compact('patient', 'mic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\Microscopy  $microscopy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, Microscopy $mic)
    {
        $mic = $patient->references()->findOrFail($mic_id);
        $this->authorize("belongs-to-user", $mic);

        $mic->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Microscopy  $microscopy
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $microscopy = HistologicalExamination::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($microscopy==null){
            abort('404');
        }
        $microscopy->delete();
        return back()->with('ok','colums delete');
    }
}
