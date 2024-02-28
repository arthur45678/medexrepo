<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\AgreementHospitalRoom;
use Illuminate\Http\Request;

class AgreementHospitalRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $patient=Patient::find($id);
        $immunologia = $patient->AgreementHospitalRoom()->onlyApproved()->get();


        return view("samples.agreement_hospital_room.index", compact('immunologia','patient'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.agreement_hospital_room.create",compact('patient'));

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
            'date' => 'required|date|before:tomorrow',
            'department_id' => 'required',
            'director' => 'required|numeric|exists:users,id',
        ]);
        $agreem=AgreementHospitalRoom::create($request->all());

        $agreem->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.agreement-hospital-room.index', $request->patient_id),
            'delay' => 2000
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\AgreementHospitalRoom  $agreementHospitalRoom
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id,$id)
    {
        $agreem = AgreementHospitalRoom::where('patient_id',$patent_id)->find($id);

        $patient=Patient::find($agreem->patient_id);

        return view("samples.agreement_hospital_room.show", compact('agreem','patient'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\AgreementHospitalRoom  $agreementHospitalRoom
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {
        $agreem = AgreementHospitalRoom::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($agreem==null){
            abort('404');
        }
        $patent=Patient::find($agreem->patient_id);

        return view("samples.agreement_hospital_room.edit", compact('agreem','patent'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\AgreementHospitalRoom  $agreementHospitalRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $patient_id)
    {

        $request->validate([
            'date' => 'required|date|before:tomorrow',
            'department_id' => 'required',
            'director' => 'required|numeric|exists:users,id',
        ]);
        $agreem=AgreementHospitalRoom::find($id);
        $agreem->update($request->all());

        $approvement = $agreem->approvement()->firstOrNew([
            "approvable_id" => $agreem->id,
            "approvable_type" => get_class($agreem)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();
        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.agreement-hospital-room.index', $patient_id),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\AgreementHospitalRoom  $agreementHospitalRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient,$id)
    {
        $agreem = AgreementHospitalRoom::where('patient_id',$patient->id)->where('user_id',auth()->id())->find($id);

        if ($agreem==null){
            abort('404');
        }
        $agreem->delete();
        $approvement=Approvement::where('approvable_type','App\Models\Samples\AgreementHospitalRoom')->where('approvable_id',$id)->delete();

        return back()->with('ok','colums delete');


    }
}
