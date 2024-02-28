<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\UltrasoundEndoscopicExamination;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\UltrasoundEndoscopicExaminationRequest;
use App\Models\Approvement;

class UltrasoundEndoscopicExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $uex_list = $patient->ultrasound_endoscopic_examinations()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.ultrasound_endoscopic_examination.index")->with(compact("uex_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.ultrasound_endoscopic_examination.create")->with(compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Samples\UltrasoundEndoscopicExaminationRequest
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(UltrasoundEndoscopicExaminationRequest $request, Patient $patient)
    {
        $patient->ultrasound_endoscopic_examinations()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $uex_id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $uex_id)
    {
        // $uex = UltrasoundEndoscopicExamination::onlyApproved()->findOrFail($uex_id);
        // $patient = Patient::avaliablePatients()->get();
        $uex = $patient->ultrasound_endoscopic_examinations()->onlyApproved()->findOrFail($uex_id);

        return view("samples.ultrasound_endoscopic_examination.show")->with(compact('patient', 'uex'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  int  $uex_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $uex_id)
    {
        $uex = $patient->ultrasound_endoscopic_examinations()->findOrFail($uex_id);
        $this->authorize("belongs-to-user", $uex);
        // $this->authorize("user-can-arrove", $uex);

        return view("samples.ultrasound_endoscopic_examination.edit")->with(compact('patient', 'uex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Samples\UltrasoundEndoscopicExaminationRequest
     * @param  \App\Models\Patient  $patient
     * @param  int $uex_id
     * @return \Illuminate\Http\Response
     */
    public function update(UltrasoundEndoscopicExaminationRequest $request, Patient $patient, UltrasoundEndoscopicExamination  $uex_id)
    {
        $uex = $patient->ultrasound_endoscopic_examinations()->findOrFail($uex_id);
        $this->authorize("belongs-to-user", $uex);

        $uex->update($request->all());

        return response()->json(['success' => 'Բոլոր դաշտերը թարմացվել են']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\UltrasoundEndoscopicExamination  $ultrasoundEndoscopicExamination
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $ultrasound_endoscopic = HistologicalExamination::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($ultrasound_endoscopic==null){
            abort('404');
        }
        $ultrasound_endoscopic->delete();
        return back()->with('ok','colums delete');
    }
}
