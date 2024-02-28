<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PaidServiceContract;
use App\Models\Samples\PaidServiceContractsServiceAndDoctor;
use Illuminate\Http\Request;

class PaidServiceContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        $apse_list = $patient->paidServiceContract()->onlyApproved()->get();
        return view("samples.paid_service_contract.index")->with(compact("apse_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $data_limit = 10;


        return view("samples.paid_service_contract.create", compact("patient", "repeatables", "data_limit"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {

        $request->validate([

            'date' => 'required|date|before:tomorrow',
            'date_start' => 'required',
            'date_end' => 'required',
            'doctor_refusal' => 'required',
            'doctor_services' => 'required',
            'doctor_intervention' => 'required',
            'doctor_period_following' => 'required',
            'price' => 'required',
            'payment_method' => 'required',
            'operates_until' => 'required',
            'director' => 'required|numeric|exists:users,id',
        ]);


        $parent_id = PaidServiceContract::create($request->all());

        if ($request->service_id):
            foreach ($request->service_id as $k => $value) {
                if ($value != null) {

                    PaidServiceContractsServiceAndDoctor::create([
                        'parent_id' => $parent_id->id,
                        'service_id' => $value,
                        'type' => 'service',
                        'service_comment' => $request->comment[$k],
                    ]);
                }
            }
        endif;
        if ($request->attending_doctor_id):
            foreach ($request->attending_doctor_id as $valueDoctor) {
                if ($valueDoctor != null) {

                    PaidServiceContractsServiceAndDoctor::create([
                        'parent_id' => $parent_id->id,
                        'doctor' => $valueDoctor,
                        'type' => 'doctor',
                    ]);
                }
            }
        endif;
        $parent_id->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.paid-service-contract.index', $patient),
            'delay' => 2000
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\PaidServiceContract $paidServiceContract
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $paid_id)
    {


        $PaidService = PaidServiceContract::where('patient_id', $patient->id)->find($paid_id);

        $services = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'service')->get();
        $doctors = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'doctor')->get();

        return view("samples.paid_service_contract.show", compact('PaidService', 'patient', 'services', 'doctors'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\PaidServiceContract $paidServiceContract
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $paid_id)
    {
        $repeatables = 5;
        $data_limit = 10;

        $PaidService = PaidServiceContract::where('patient_id', $patient->id)->where('user_id', auth()->id())->find($paid_id);
        if ($PaidService == null) {
            abort('404');
        }
        $services = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'service')->get();
        $doctors = PaidServiceContractsServiceAndDoctor::where('parent_id', $paid_id)->where('type', 'doctor')->get();

        return view("samples.paid_service_contract.edit", compact('PaidService', 'patient', 'repeatables', 'data_limit', 'services', 'doctors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\PaidServiceContract $paidServiceContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $apse_id)
    {
        $request->validate([

            'date' => 'required|date|before:tomorrow',
            'date_start' => 'required',
            'date_end' => 'required',
            'doctor_refusal' => 'required',
            'doctor_services' => 'required',
            'doctor_intervention' => 'required',
            'doctor_period_following' => 'required',
            'price' => 'required',
            'payment_method' => 'required',
            'operates_until' => 'required',
            'director' => 'required|numeric|exists:users,id',
        ]);


        $parent = PaidServiceContract::find($apse_id);
        $parent->update($request->all());

        if ($request->service_id):
            foreach ($request->service_id as $k => $value) {
                if ($value != null) {

                    PaidServiceContractsServiceAndDoctor::create([
                        'parent_id' => $parent->id,
                        'service_id' => $value,
                        'type' => 'service',
                        'service_comment' => $request->comment[$k],
                    ]);
                }
            }
        endif;
        if ($request->attending_doctor_id):
            foreach ($request->attending_doctor_id as $valueDoctor) {
                if ($valueDoctor != null) {

                    PaidServiceContractsServiceAndDoctor::create([
                        'parent_id' => $parent->id,
                        'doctor' => $valueDoctor,
                        'type' => 'doctor',
                    ]);
                }
            }
        endif;
        $approvement = $parent->approvement()->firstOrNew([
            "approvable_id" => $parent->id,
            "approvable_type" => get_class($parent)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.paid-service-contract.index', $patient),
            'delay' => 2000
        ], 201);

    }

    public function trash($data)
    {
        PaidServiceContractsServiceAndDoctor::find($data)->delete();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\PaidServiceContract $paidServiceContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $paid_id)
    {

        $PaidService = PaidServiceContract::where('patient_id', $patient->id)->where('user_id', auth()->id())->find($paid_id);
        if ($PaidService == null) {
            abort('404');
        }
        $PaidService->delete();
        Approvement::where('approvable_type', 'App\Models\Samples\PaidServiceContract')->where('approvable_id', $paid_id)->delete();
        return back();
//        dd(  $parent_id->approvement());
    }
}
