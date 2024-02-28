<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientConnection;
use App\Models\Queue;

use Gate;

use App\Contracts\Models\HasAttachments;

class PatientsController extends Controller
{
    public $patients = [
        [
            'id' => 1,
            'name' => 'Կարեն',
            'lastname' => 'Կարապետյան',
            'patronymic' => 'Կարապետի',
            'birthday' => '03.04.1985',
            'passport' => 'AF01020304',
            'm_phone' => '+37496275767',
            'tel_num' => '010364656',
            'strit' => 'Տ․ Պետրոսյան',
            'building' => '6',
            'house' => '34',

            'type' => 'ամբուլատոր' // do we need here ?
        ],
        [
            'id' => 2,
            'name' => 'Սուրեն',
            'lastname' => 'Սուրենյան',
            'patronymic' => 'Սուրենի',
            'birthday' => '03.04.1955',
            'passport' => 'AM01020305',
            'm_phone' => '+37496275777',
            'tel_num' => '010364666',
            'strit' => 'Հ․ Չարենց',
            'building' => '6',
            'house' => '34',

            'type' => 'ստացիոնար' // do we need here ?
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //        $xmlFile = simplexml_load_file(public_path('example.xml'));
        //
        //        foreach ($xmlFile->recordTarget as $patienst){
        //            foreach ($patienst->patientRole->patient->name->given as $info){
        //                dump($info);
        //            }
        //        }
        //        dd('avart');
        //dump($xmlFile->recordTarget->patientRole->patient);
        //        dump($xmlFile->recordTarget->patientRole->patient->name->given);
        //        dump($xmlFile->recordTarget->patientRole->patient->name->family);
        //        dump($xmlFile->recordTarget->patientRole->patient->name->patronymic);
        //        dump($xmlFile->recordTarget->patientRole->patient->administrativeGenderCode->attributes()->displayName);
        //        dump($xmlFile->recordTarget->patientRole->patient->birthTime->attributes()[0]);

        $this->authorize('viewAny', 'App\Models\Patient');
        $patients = Patient::availablePatientsTwo()->get(); // Querying by relationships
        // $patients = Patient::availablePatients()->get(); // Querying by builder
        // $patients = Patient::availablePatientsTwoApi(\App\Models\User::find(2))->get(); // Testing Api

        return view('patients.index', compact('patients'));
    }

    public function showarchives(){
        $this->authorize('viewAny', 'App\Models\Patient');
        $patients = Patient::where(['archive'=>1])->get();
        return view('patients.index', compact('patients'));
    }

    public function list()
    {
        $patients = Patient::all();
        return view('patients.list', compact('patients'));
    }

    public function rowgroup()
    {
        $patients = $this->patients;
        return view('patients.rowgroup', compact('patients'));
    }

    public function load_from_armed(Request $request)
    {
        $request->validate([
            "soc_card" => 'required|numeric|unique:patients,soc_card'
        ]);

        if ($request->ajax()) {
            //Load data here
            $user = [
                "f_name" => "Սիմոն",
                "l_name" => "Սիմոնյան",
                "p_name" => "Սիմոնի",
                "c_phone" => "010397756",
                "m_phone" => "094397756",
                "email" => "simon@gmail.com",
                "soc_card" => $request->soc_card,
                "passport" => "DG01234567",
                "nationality" => "հայ",
                "sex" => "տղամարդ",
                "residence_region" => "Երևան",
                "town_village" => "Ք․ Երևան",
                "street_house" => "Գարեգին Նժդեհի 45",
                "workplace" => "Այստեղ ՍՊԸ",
                "profession" => "սպասարկող",
                "birth_date" => "1966-04-02"
            ];

            sleep(5);
            return response()->json(["user" => $user]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Patient::class);
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $this->authorize('create', Patient::class);
        $patient = new Patient($request->all());
        $patient_saved = $patient->save();
        $connection_created = true;

        if (auth()->user()->hasRole('doctor')) {
            $connection_created = PatientConnection::create([ // եթե չստացվի, կդառնա false
                "sender_id" => auth()->id(),
                "receiver_id" => auth()->id(),
                "patient_id" => $patient->id
            ]);
        }

        if ($patient_saved && $connection_created) {
            return redirect()->route('patients.show', $patient->id);
        }
        return back()->with(['error' => 'Patient was not saved or connected']);
    }

    # only one change (StationaryController) - the name of the file is storing with "-" between orig-name and time().
    private function storeAttachmentsForPatient(Request $request, HasAttachments $model, Patient $patient, string $key = "attachments", bool $multiple = true)
    {
        if (!$request->hasFile($key)) return false;
        $class_name = class_basename(get_class($model));
        $files = $request->file($key);
        $attachments = [];

        if (!$multiple) $files = [$files];

        foreach ($files as $n => $attachment) {
            $attachment_name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME) . "-" .  time() . "." . $attachment->getClientOriginalExtension();
            $directory = "/public/patients/{$patient->id}/{$class_name}";
            $attachment->storePubliclyAs($directory, $attachment_name);
            if ($request->has("attachment_comments")) {
                $attachment_comment = $request->attachment_comments[$n];
                array_push($attachments, $model->attachments()->create(compact("attachment_name", "attachment_comment", "directory")));
            } else {
                array_push($attachments, $model->attachments()->create(compact("attachment_name", "directory")));
            }
        }

        return $attachments;
    }

    public function store_file(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|numeric',
            'attachment_comments' => 'required|array',
            'attachment_comments.*' => 'nullable|string',
            'attachments' => 'required|file|max:50000'
        ]);

        $patient = Patient::findOrFail($request->patient_id);
        $attachments_saved = $this->storeAttachmentsForPatient($request, $patient, $patient, 'attachments', false);
        return redirect()->route('patients.show',$patient)->with('success', 'Հաջողությամբ ավելացվել է');

//        return response()->json(["success" => __("patients.store_file_success"), "attachments" => $attachments_saved]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Model\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {

        $this->authorize('view', $patient);
        $patients = Patient::availablePatientsTwo()->pluck('id');
        if (!$patients->contains($patient->id)) {
            abort(403, __('authorization.user.not-belongs-to-user'));
        }

//         dd(Patient::samples_relations());
        $patient_with_relations = Patient::with(Patient::samples_relations())->find($patient->id);

        $patient_samples = Patient::get_patient_samples($patient_with_relations);
        $has_ambulator = $patient_with_relations->ambulator ? true : false;
        $is_patient_connection_creator = PatientConnection::where([
            ['sender_id', '=', auth()->id()],
            ['receiver_id', '=', auth()->id()],
            ['patient_id', '=', $patient->id]
        ])->first();
        // $all_samples = array_values(Patient::available_samples());
        return view("patients.show")->with(compact("patient", "patient_samples", "has_ambulator", "is_patient_connection_creator"));
    }

    public function barcode(Patient $patient)
    {
        $this->authorize('view', $patient);
        return view("patients.barcode")->with(compact("patient"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Model\Patient  $patient
     * @return \Illuminate\Http\Response
     * !!! without Request $request Policy not working !!!
     * !! http://www.codekayak.net/argument-2-passed-appprovidersauthserviceproviderappprovidersclosure-must-instance-apppost/
     */
    public function edit(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        return view("patients.edit", compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        if (Gate::allows('update patients')) {
            // $patient = Patient::findOrFail($id); // Check, if the user has access to the patient here
            $patient->update($request->all());
            return response()->json(["success" => __("patients.updated")]);
        }
        return response()->json(["warning" => __('authorization.user.can-not-update-patients')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $this->authorize('delete', $patient);

        // 1. check sender_id nad receiver_id the same into "patient_connection" (for doctor)
        // 2. does not exists any amb or stationar into system ( for both - receptionist and doctor)

        $delete_respone = false;
        $is_patient_connection_creator = PatientConnection::where([
            ['sender_id', '=', auth()->id()],
            ['receiver_id', '=', auth()->id()],
            ['patient_id', '=', $patient->id]
        ])->first();

        if (auth()->user()->hasRole('receptionist')) {
            if (
                $patient && is_null($patient->ambulator)
                && $patient->stationaries->isEmpty()
            ) {
                foreach ($patient->referrals as $referral) {
                    Queue::where('referral_id', '=', $referral->id)->delete();
                    $referral->services()->detach();
                    $referral->delete();
                }
                PatientConnection::where('patient_id', $patient->id)->delete();
                $patient->delete();
                $delete_respone = true;
            }
        }

        if (auth()->user()->hasRole('doctor')) {
            if (
                $patient && $is_patient_connection_creator
                && is_null($patient->ambulator) && $patient->stationaries->isEmpty()
            ) {

                foreach ($patient->referrals as $referral) {
                    Queue::where('referral_id', '=', $referral->id)->delete();
                    $referral->services()->detach();
                    $referral->delete();
                }
                PatientConnection::where('patient_id', $patient->id)->delete();
                $patient->delete();
                $delete_respone = true;
            }
        }
        if ($delete_respone) {
            return redirect()->route('patients.index')->withSuccess(__('patients.deleted'));
        }
        abort(403, __('patients.has_ambulator_or_stationaries'));
    }
}
