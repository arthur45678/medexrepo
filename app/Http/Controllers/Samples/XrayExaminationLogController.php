<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\XrayExaminationLog;
use App\Models\Patient;
use App\Models\Approvement;
use Illuminate\Http\Request;

class XrayExaminationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $xray_list = $patient->xray_examination_logs()->onlyApproved()->with("attending_doctor")->get();

        return view("samples.xray_examination_log.index")->with(compact("xray_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {

        return view("samples.xray_examination_log.create")->with(compact('patient',));
       
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
            'reg_date' => 'required',
            'examining_doctor_id' => 'required|numeric|exists:users,id',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $patient->xray_examination_logs()->create($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.xray-examination-log.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\XrayExaminationLog  $xra
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $xray_id)
    {
        $xray = $patient->xray_examination_logs()->onlyApproved()->findOrFail($xray_id);
     
        return view("samples.xray_examination_log.show")->with(compact('patient', 'xray'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\XrayExaminationLog  $xray
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $xray_id)
    {
        $xray = $patient->xray_examination_logs()->findOrFail($xray_id);
        $this->authorize("belongs-to-user", $xray);

        return view("samples.xray_examination_log.edit")->with(compact('patient', 'xray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\XrayExaminationLog  $xray
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $xray_id)
    {
        $xray = $patient->xray_examination_logs()->findOrFail($xray_id);
        $this->authorize("belongs-to-user", $xray);

        $xray->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\XrayExaminationLog  $xray
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $xray_examination = XrayExaminationLog::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($xray_examination==null){
            abort('404');
        }
        $xray_examination->delete();
        return back()->with('ok','colums delete');
    }
}
