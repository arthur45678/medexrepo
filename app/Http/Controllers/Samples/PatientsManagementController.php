<?php

namespace App\Http\Controllers\Samples;

use App\Enums\Samples\SampleMedicinelistsEnum;
use App\Http\Controllers\Controller;
use App\Models\MeasurementUnit;
use App\Models\Patient;
use App\Models\Samples\Echocardiogram;
use App\Models\Samples\PatientsManagement;
use App\Models\Samples\SamplesMedicinelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = PatientsManagement::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();

        return view("samples.patients_management.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 25;
        return view("samples.patients_management.create", compact('patient','repeatables'));
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
            'attending_doctor_id' => 'nullable|numeric',
            'nurse_doctor_id' => 'nullable|numeric',
        ]);

        $patientManagment = new PatientsManagement();
        $patientManagment->storeData($request, $patient);

        foreach ($request['medicinelists_id'] as $m => $value) {
            if ($value != null):
                $prescraption = SamplesMedicinelist::create([
                    'card_id' => $patientManagment->id,
                    'user_id' => auth()->user()->id,
                    'patient_id' => $request->patient_id,
                    'medicineLists_type' => SampleMedicinelistsEnum::patients_management(),
                    'medicinelists_id' => $value,
                    'drug_using_time' => $request['drug_using_time'][$m],
                    'medicinelists_comment' => $request['medicinelists_comment'][$m],
                ]);
            endif;
        }
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\PatientsManagement  $patientsManagement
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        return view("samples.patients_management.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\PatientsManagement  $patientsManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $id)
    {

        $repeatables = 25;
        $post = $patient->patients_managements()->findOrFail($id);

        $this->authorize("belongs-to-user", $post);
        $medicineLists = $post->getMedicineLists($id);

        return view("samples.patients_management.edit")->with(compact('repeatables','patient', 'post','medicineLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\PatientsManagement  $patientsManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Patient $patient, $conscious_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'nullable|numeric',
            'nurse_doctor_id' => 'nullable|numeric',
        ]);
        $conscious = $patient->conscious_voluntary_consents()->findOrFail($conscious_id);

        $this->authorize("belongs-to-user", $conscious);

        $res = $conscious->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    public function medicinelistsUpdate(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\PatientsManagement  $patientsManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientsManagement $patientsManagement)
    {
        //
    }
}
