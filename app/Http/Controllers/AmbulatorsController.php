<?php

namespace App\Http\Controllers;

use App\Models\Approvement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\AmbulatorUpdateRequest;

use App\Models\Ambulator;
use App\Models\CancerGroup;
use App\Models\Clinic;
use App\Models\Harmful;
use App\Models\Patient;
use App\Models\Attendance;
use App\Models\Diagnosis;
use App\Models\Stationary;
use App\Models\PatientFirstInfo;

use App\Models\Complaint;
use App\Models\Tnm;
use App\Models\FemaleIssue;
use App\Models\OnsetAndDevelopment;
use App\Models\TumorInfo;

use App\Models\MeasurementUnit;
use App\Models\HealthStatus;
use App\Models\Prescription;

use DB;

use Illuminate\Support\Facades\Validator;

class AmbulatorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $patientAmbulator = Ambulator::where('patient_id', $patient->id)->get();
        // dd($patientAambulator);
        return view('ambulators.index', compact('patientAmbulator', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        if ($patient->ambulator) {
            abort(201, 'Տվյալ հիվանդի ամբուլատոր քարտն արդեն բացված է։', [
                'goto' => route('patients.ambulator.index', ['patient' => $patient]),
                'goto_text' => 'Ամբուլատոր քարտ'
            ]);
            // return redirect()->route('patients.ambulator.index', ['patient' => $patient]);
        }

        $cancer_groups = CancerGroup::all();
        $harmfuls = Harmful::all();
        $clinics = Clinic::all();

        return view("ambulators.create")->with(compact("patient", "cancer_groups", "harmfuls", "clinics"));
        // return view("patients.ambulator")->with(compact("patient", "cancer_groups", "harmfuls", "clinics"));
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
            "harmfuls" => "nullable|array",
            "cancer_group" => "nullable|numeric",
            "registration_date" => "required|date|before:tomorrow|after:1970-01-01",
            "first_clinic" => "nullable|string|max:255",
            "first_clinic_date" => "nullable|date|before:tomorrow|after:1900-01-01",
            "first_discovered" => "nullable|string|max:255",
            "first_discovered_date" => "nullable|date|before:tomorrow|after:1900-01-01",
            "past_treatments" => "nullable|string"
        ]);
        $start_year = Carbon::now()->startOfYear()->toDateString();
        $amb = Ambulator::where('created_at', '>=', $start_year . ' 00:00:00')->orderBy('id', 'desc')->first();

        if ($amb != null) {
            $number = $amb->number + 1;
        } else {
            $number = 1;
        }


        return DB::transaction(function () use ($request, $patient, $number) {

            $harmfuls = $request->harmfuls;
            $patient->harmfuls()->attach($harmfuls);

            $patient->cancer_groups()->attach($request->cancer_group);

            if($request->anyFilled([
                'first_clinic',
                'first_clinic_date',
                'first_discovered',
                'first_discovered_date',
                'past_treatments'
            ])) {
                $patient->first_info()->create($request->except(["harmfuls", "cancer_group", "registration_date"]));
            }

            $patient->ambulator()->create(["number" => $number, "registration_date" => $request->registration_date]);

            return redirect()->route('patients.ambulator.index', ['patient' => $patient])->withSuccess(__("ambulator.created"));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  int  $ambulator_id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $ambulator_id)
    {
        $ambulator = $patient->ambulator()->find($ambulator_id); //This can be changed later. Ambulator is hasOne, no need to check id

        $stationary = $patient->stationaries->all();
        // dd($stationary->all());

        $histological = DB::table('stationary_histological_examinations')->where('id', '=', $patient->id)->get();

        $cellular = DB::table('stationary_cellular_examinations')->where('id', '=', $patient->id)->get();
        // dd($histological);

        $stationaries = DB::table('stationaries')
            ->join('stationary_surgeries', 'stationaries.id', '=', 'stationary_surgeries.stationary_id')
            ->select(
                'stationaries.id as stationary_id',
                'stationaries.admission_date',
                'stationaries.discharge_date',
                'stationaries.number',
                'stationary_surgeries.id as surgery_id',
                'stationary_surgeries.surgery_date'
            )->where('stationaries.patient_id', '=', $patient->id)->get();

        $patient = $patient->with([
            'first_info',
            'harmfuls',
            'cancer_groups',
            'ambulator'
        ])->where('id', '=', $patient->id)->first();
        $for_pdf = false;

        $first_info = PatientFirstInfo::where('patient_id', '=', $patient->id)->with('first_clinic_item', 'first_discovered_item')->get();
        // $first_info = $patient->first_infos->with('first_clinic','first_discovered')->get();
        // dd($first_info);

        return view('ambulators.show_page1', compact('patient', 'ambulator', 'for_pdf', 'stationaries', 'histological', 'first_info', 'cellular'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ambulator  $ambulator
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Ambulator $ambulator)
    {
        $this->authorize('ambulator-not-belongs-to-patient', [$patient, $ambulator]);
        $repeatables = 10;

        $stationaries = DB::table('stationaries')
            ->leftJoin('stationary_surgeries', 'stationaries.id', '=', 'stationary_surgeries.stationary_id')
            ->select(
                'stationaries.id as stationary_id',
                'stationaries.admission_date',
                'stationaries.discharge_date',
                'stationaries.number',
                'stationary_surgeries.id as surgery_id',
                'stationary_surgeries.surgery_date'
            )->where('stationaries.patient_id', '=', $patient->id)->get();

        $preliminary_diagnosis = $ambulator->preliminary_diagnosis() ?? new Diagnosis(['type' => 'preliminary']);
        $final_diagnosis = $ambulator->final_diagnosis() ??  new Diagnosis(['type' => 'final']);

        $previous_diagnoses = $ambulator->previous_diagnoses();

        $complaints = $ambulator->complaints->filter(function ($complaint) {
            return $complaint->user_id === auth()->id();
            // return intval($complaint->user_id) === auth()->id();
        });

        $tnms = $ambulator->tnms->filter(function ($tnm) {
            return $tnm->user_id === auth()->id();
        });

        $female_issues = $ambulator->female_issues ?? new FemaleIssue(['ambulator_id' => $ambulator->id]);

        $oads = $ambulator->onset_and_developments->filter(function ($oad) {
            return $oad->user_id === auth()->id();
        });

        $tumor_infos = $ambulator->tumor_infos->filter(function ($tumor_info) {
            return $tumor_info->user_id === auth()->id();
        });

        $health_statuses = $ambulator->health_statuses->filter(function ($health_status) {
            return $health_status->user_id === auth()->id();
        });

        $measurement_units = MeasurementUnit::select('id', 'name')->get();


        $patient = $patient->where('id', '=', $patient->id)->with([
            'first_info',
            'harmfuls',
            'cancer_groups',
            'ambulator',
            'patient_first_infos'
        ])->first();
        // dd($patient);

        $cancer_groups = CancerGroup::all();
        $clinics = Clinic::all();
        $harmfuls = Harmful::all();

        $tCollectionJson = Tnm::tCollectionJson();
        $nCollectionJson = Tnm::nCollectionJson();
        $mCollectionJson = Tnm::mCollectionJson();

        $gradeCollectionJson = Tnm::gradeCollectionJson();
        $lCollectionJson = Tnm::lCollectionJson();
        $vCollectionJson = Tnm::vCollectionJson();
        $pycmrCollectionJson = Tnm::pycmrCollectionJson();

        $edit_blade = auth()->user()->hasRole('receptionist') ? 'ambulators.edit_reception' : 'ambulators.edit';

        return view($edit_blade)->with(
            compact(
                'tCollectionJson',
                'nCollectionJson',
                'mCollectionJson',

                'gradeCollectionJson',
                'lCollectionJson',
                'vCollectionJson',
                'pycmrCollectionJson',

                "harmfuls",
                "cancer_groups",
                "clinics",
                "ambulator",
                "patient",
                "repeatables",
                "stationaries",
                "preliminary_diagnosis",
                "final_diagnosis",
                "previous_diagnoses",
                "complaints",
                "tnms",
                "female_issues",
                "oads",
                "tumor_infos",
                "health_statuses",
                "measurement_units"
            )
        );
    }

    public function update_harmfuls(Request $request, $patient_id, $ambulator_id)
    {
        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $patient = Patient::findOrFail($patient_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            $patient,
            $ambulator
        ]);

        $validator = Validator::make($request->all(), [
            'harmfuls' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $harmfuls = $request->harmfuls ?? null;
        $patient->harmfuls()->sync($harmfuls);

        return response()->json(['success' => __('ambulator.saved')]);

    }

    public function update_regis_date(Request $request, $patient_id, $ambulator_id)
    {

        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $validator = Validator::make($request->all(), [
            'registration_date' => 'required|date|before:tomorrow|after:1970-01-01'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $ambulator->registration_date = $request->registration_date;
        $ambulator->save();

        return response()->json(['success' => __('ambulator.saved')]);
    }

    public function delete_first_infos(Request $request, $ambulator_id)
    {
        $request->validate([
            'first_info_id' => 'required|numeric|exists:patient_first_infos,id',
            'hide_form_id' => 'required|string'
        ]);
        // dd($request->all());

        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $first_info = PatientFirstInfo::where([
            ['id', '=', $request->first_info_id],
            ['user_id', '=', auth()->id()],
            ['patient_id', '=', $ambulator->patient_id]
        ])->first();
        // dd($first_info);

        if (!$first_info) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        $first_info->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_first_infos(Request $request, $patient_id, $ambulator_id)
    {
        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $request->validate([
            "first_clinic" => "nullable|exists:clinics,id",
            "first_clinic_date" => "nullable|date|before:tomorrow|after:1900-01-01",
            "first_discovered" => "nullable|exists:clinics,id",
            "first_discovered_date" => "nullable|date|before:tomorrow|after:1900-01-01",
            "past_treatments" => "nullable|string",

            "first_info_id" => "nullable|exists:patient_first_infos,id",
            "wrapper_id" => "nullable|string"
        ]);

        $first_info = PatientFirstInfo::find($request->first_info_id) ??
            new PatientFirstInfo(['patient_id' => $patient_id]);

        $fillable = $request->except('first_info_id');
        $first_info->fill($fillable)->save();

        $response_array = ['success' => __("ambulator.first_info.updated")];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . $request->wrapper_id;

        # create
        if (!$request->filled('first_info_id')) {
            return redirect($scroll_to)->withSuccess(__("ambulator.first_info.created"));
        }
        # update
        return response()->json($response_array);
    }

    public function delete_hs_prescriptions(Request $request, $ambulator_id)
    {
        // return response()->json(['tata' => $request->all()]);
        $validator = Validator::make($request->all(), [
            'hs_prescription_id' => 'required|numeric|exists:prescriptions,id',
            'reset_form_id' => 'required|string',
            'data_reset' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }
        // return response()->json(['data' => $request->all()]);

        $prescription = Prescription::where([
            ['id', '=', $request->hs_prescription_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();
        // return response()->json(['data' => $prescription]);

        if (!$prescription) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'resetFormId' => $request->reset_form_id
            ]);
        }

        $prescription->delete();

        return response()->json(['data' => [
            // 'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'resetFormId' => $request->reset_form_id,
            'dataReset' => $request->data_reset,
            'hideResetForm' => true
        ]]);
    }


    public function delete_health_statuses(Request $request, $ambulator_id)
    {
        $request->validate([
            'health_status_id' => 'required|numeric|exists:health_statuses,id',
            'hide_form_id' => 'required|string'
        ]);
        // dd($request->all());

        $health_status = HealthStatus::where([
            ['id', '=', $request->health_status_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->with('prescriptions')->first();
        // dump($health_status);

        if (!$health_status) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        $health_status->prescriptions()->delete();
        $health_status->delete();
        Approvement::where('approvable_type', 'App\Models\HealthStatus')->where('approvable_id', $request->health_status_id)->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_health_statuses(Request $request, $patient_id, $ambulator_id)
    {
        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $request->validate([
            'health_status_date' => 'required|date|before:tomorrow',
            'health_status_text' => 'nullable|string',

            'prescription_length' => 'required|numeric',
            'prescription_medicine_id' => 'required|array',
            'prescription_medicine_id.*' => 'nullable|numeric|exists:medicine_lists,id',

            'prescription_medicine_dose' => 'required|array',
            'prescription_medicine_dose.*' => 'nullable|numeric',

            'prescription_medicine_measure' => 'required|array',
            'prescription_medicine_measure.*' => 'nullable|numeric|exists:measurement_units,id',

            'prescription_text' => 'required|array',
            'prescription_text.*' => 'nullable|string',

            'prescription_id' => 'nullable|array'
        ]);
        // dump($request->all());
        // return response()->json(['up' => $request->all()]);
        $data_health = $request->only(['health_status_date', 'health_status_text']);
        $health_status = HealthStatus::find($request->id) ?? new HealthStatus(['ambulator_id' => $ambulator_id]);
        $health_status->fill($data_health)->save();
        // dump($health_status);
        $approvement = $health_status->approvement()->firstOrNew([
            "approvable_id" => $health_status->id,
            "approvable_type" => get_class($health_status)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();
        $prescription_medicine_ids = array_filter(array_slice($request->prescription_medicine_id, 0, $request->prescription_length));
        // dump($prescription_medicine_ids);

        if (count($prescription_medicine_ids)) {

            foreach ($prescription_medicine_ids as $key => $medicine_id) {
                $prescription_id = $request->prescription_id[$key] ?? null;
                // dump($prescription_id);
                $prescription = Prescription::find($prescription_id) ??
                    new Prescription([
                        "patient_id" => $patient_id,
                        "ambulator_id" => $ambulator_id,
                        "user_id" => $health_status->user_id,
                        "health_status_id" => $health_status->id
                    ]);
                $prescription->fill([
                    "medicine_id" => $medicine_id,
                    "prescription_text" => $request->prescription_text[$key],
                    "medicine_dose" => $request->prescription_medicine_dose[$key],
                    "measurement_unit_id" => $request->prescription_medicine_measure[$key],
                ])->save();
                // dump($prescription);
            }
        }

        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#health-status-section';
        $response_array = ["success" => __("ambulator.health_status.updated")];
        if (!$request->filled('id')) { // has not prescription_id - is create.
            return redirect($scroll_to)->withSuccess(__("ambulator.health_status.created")); // ajax-submitable-off
            // $response_array["redirect"] = $edit_route;
            // $response_array["delay"] = 1300;
        }
        return response()->json($response_array);
    }

    public function update_is_a_twin(Request $request, $patient_id, $ambulator_id)
    {

        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $request->validate([
            'ambulator_id' => 'nullable|numeric',
            'is_a_twin' => 'required|boolean'
        ]);

        $ambulator->is_a_twin = $request->is_a_twin;
        $ambulator->save();

        return response()->json(['success' => __('ambulator.is_a_twin.updated')]);
    }

    public function delete_cancer_groups(Request $request, $ambulator_id)
    {
        // $request->validate([
        $validator = Validator::make($request->all(), [
            'pivot_id' => 'required|numeric|exists:cancer_group_patient,id',
            'cancer_group_id' => 'nullable|numeric|exists:cancer_groups,id',
            'hide_form_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $ambulator = Ambulator::find($ambulator_id);
        $patient = Patient::find($ambulator->patient_id);

        if (!$ambulator || !$patient) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        // $patient->cancer_groups()->detach($request->cancer_group_id);
        $cancer_group = $patient->cancer_groups()->wherePivot('id', $request->pivot_id)->first();
        $cancer_group->pivot->delete();

        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_cancer_groups(Request $request, $patient_id, $ambulator_id)
    {

        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $patient = Patient::findOrFail($patient_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            $patient,
            $ambulator
        ]);

        $request->validate([
            'pivot_id' => 'nullable|numeric|exists:cancer_group_patient,id',
            'cancer_group_id' => 'required|numeric|exists:cancer_groups,id',
            'wrapper_id' => 'nullable|string'
        ]);

        $response_array = ['success' => __("ambulator.cancer_group.updated")];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . $request->wrapper_id;

        # create
        if (!$request->filled('pivot_id')) {
            $patient->cancer_groups()->sync([$request->cancer_group_id], false);
            return redirect($scroll_to)->withSuccess(__("ambulator.cancer_group.created"));
        }

        # update
        $cancer_group = $patient->cancer_groups()->wherePivot('id', $request->pivot_id)->first();
        $cancer_group->pivot->cancer_group_id = $request->cancer_group_id;
        $cancer_group->pivot->save();
        return response()->json($response_array);
    }

    public function delete_tumor_info(Request $request, $ambulator_id)
    {

        $request->validate([
            'tumor_info_id' => 'required|numeric|exists:tumor_infos,id',
            'hide_form_id' => 'required|string'
        ]);
        // dd($request->all());

        $tumor_info = TumorInfo::where([
            ['id', '=', $request->tumor_info_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();
        // dd($oad);

        if (!$tumor_info) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        $tumor_info->delete();
        Approvement::where('approvable_type', 'App\Models\TumorInfo')->where('approvable_id', $request->tumor_info_id)->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_tumor_info(Request $request, $patient_id, $ambulator_id)
    {
        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $request->validate([
            'tumor_id' => 'nullable|numeric|exists:tumor_infos,id',
            'tumor_date' => 'required|date|before:tomorrow',
            'tumor_description' => 'required|string'
        ]);

        $tumor_info = TumorInfo::find($request->tumor_id) ??
            new  TumorInfo(['ambulator_id' => $ambulator_id]);

        $fillable = $request->except(['tumor_id']);
        $tumor_info->fill($fillable)->save();
        $approvement = $tumor_info->approvement()->firstOrNew([
            "approvable_id" => $tumor_info->id,
            "approvable_type" => get_class($tumor_info)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();
        // $tumor_msg = $request->oad_id ? __("ambulator.tumor_info.updated") : __("ambulator.tumor_info.created");
        // return response()->json(['success' => $tumor_msg]);

        $response_array = ['success' => __("ambulator.tumor_info.updated")];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#tumor-info-section';

        # create
        if (!$request->filled('tumor_id')) {
            return redirect($scroll_to)->withSuccess(__("ambulator.tumor_info.created"));
        }
        # update
        return response()->json($response_array);
    }

    public function delete_onset_and_developments(Request $request, $ambulator_id)
    {
        $request->validate([
            'oad_id' => 'required|numeric|exists:onset_and_developments,id',
            'hide_form_id' => 'required|string'
        ]);
        // dd($request->all());

        $oad = OnsetAndDevelopment::where([
            ['id', '=', $request->oad_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();
        // dd($oad);

        if (!$oad) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        $oad->delete();
        Approvement::where('approvable_type', 'App\Models\OnsetAndDevelopment')->where('approvable_id', $request->oad_id)->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_onset_and_developments(Request $request, $patient_id, $ambulator_id)
    {
        $ambulator =  Ambulator::findOrFail($ambulator_id);
        $this->authorize('ambulator-not-belongs-to-patient', [
            Patient::findOrFail($patient_id),
            $ambulator
        ]);

        $request->validate([
            'oad_id' => 'nullable|numeric|exists:onset_and_developments,id',
            'oad_date' => 'required|date|before:tomorrow',
            'oad_comment' => 'required|string'
        ]);

        $oad = OnsetAndDevelopment::find($request->oad_id) ??
            new  OnsetAndDevelopment(['ambulator_id' => $ambulator_id]);

        $fillable = $request->except(['oad_id']);
        $oad->fill($fillable)->save();
        $approvement = $oad->approvement()->firstOrNew([
            "approvable_id" => $oad->id,
            "approvable_type" => get_class($oad)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();
        $response_array = ['success' => __("ambulator.oad.updated")];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#ambulator-oad-section';

        # create
        if (!$request->filled('oad_id')) {
            return redirect($scroll_to)->withSuccess(__("ambulator.oad.created"));
        }
        # update
        return response()->json($response_array);
    }

    public function update_female_issues(Request $request, $patient_id, $ambulator_id)
    {
        // dd('dada');

        $request->validate([
            'number_of_births' => 'nullable|numeric',
            'number_of_abortions' => 'nullable|numeric',
            'date_of_last_birth' => 'nullable|date|before:tomorrow',
            'breast_inflammation' => 'nullable|string',
            'menstruation_date' => 'nullable|date|before:tomorrow',
            'menstruation' => 'nullable|string',
            'breastfeeding_complications' => 'nullable|string',
            'female_issues_id' => 'nullable|numeric|exists:female_issues,id',
        ]);

        $fillable = $request->except(['female_issues_id']);
        $female_issues = FemaleIssue::find($request->female_issues_id) ?? new FemaleIssue([
            'ambulator_id' => $ambulator_id,
        ]);
        $female_issues->fill($fillable)->save();

        $approvement = $female_issues->approvement()->firstOrNew([
            "approvable_id" => $female_issues->id,
            "approvable_type" => get_class($female_issues)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        $response_array = ['success' => __("ambulator.saved")];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#ambulator-female-issues';

        return redirect($scroll_to)->withSuccess(__("ambulator.saved"));
        // return back()->withSuccess(__("ambulator.saved"));
    }

    public function delete_tnms(Request $request, $ambulator_id)
    {
        $request->validate([
            'tnm_id' => 'required|numeric|exists:tnms,id',
            'hide_form_id' => 'required|string'
        ]);

        $tnm = Tnm::where([
            ['id', '=', $request->tnm_id],
            ['user_id', '=', auth()->id()],
            ['tnmable_id', '=', $ambulator_id]
        ])->first();

        if (!$tnm) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }
        Approvement::where('approvable_type', 'App\Models\Tnm')->where('approvable_id', $request->tnm_id)->delete();
        $tnm->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }



    public function update_tnms(Request $request, $patient_id, $ambulator_id)
    {

        $ambulator = Ambulator::where([['patient_id', '=', $patient_id], ['id', '=', $ambulator_id]])->first();
        if (!$ambulator) return response()->json(['warning' => __("ambulator.ambulator-not-belongs-to-patient")]);

        $request->validate([
            'tnm_id' => 'nullable|numeric|exists:tnms,id',
            'T' => 'nullable|string',
            'N' => 'nullable|string',
            'M' => 'nullable|string',

            "Grade" => 'nullable|string',
            "L" => 'nullable|string',
            "V" => 'nullable|string',
            "pycmr" => 'nullable|string',
        ]);

        $fillable = $request->only(['T', 'N', 'M', 'Grade', 'L', 'V', 'pycmr']);
        $tnm = Tnm::find($request->tnm_id) ?? new Tnm([
            'user_id' => auth()->id(),
            'tnmable_type' => get_class($ambulator),
            'tnmable_id' => $ambulator->id
        ]);

        $tnm->fill($fillable)->save();
        $approvement = $tnm->approvement()->firstOrNew([
            "approvable_id" => $tnm->id,
            "approvable_type" => get_class($tnm)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        // $tnm_msg = $request->tnm_id ? __("ambulator.tnm.updated") : __("ambulator.tnm.created");
        $response_array = ['success' => __("ambulator.tnm.updated")];

        if (!$request->filled('tnm_id')) {
            $response_array['success'] = __("ambulator.tnm.created");
            $response_array['redirectWithHash'] = route(
                'patients.ambulator.edit',
                [
                    "patient" => $patient_id,
                    "ambulator" => $ambulator_id
                ]
            );
        }
        return response()->json($response_array);
    }

    public function delete_complaints(Request $request, $ambulator_id)
    {
        $request->validate([
            'complaint_id' => 'required|numeric|exists:complaints,id',
            'hide_form_id' => 'required|string'
        ]);
        // dd($request->all());

        $complaint = Complaint::where([
            ['id', '=', $request->complaint_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();
        // dd($complaint);

        if (!$complaint) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }
        Approvement::where('approvable_type', 'App\Models\Complaint')->where('approvable_id', $request->complaint_id)->delete();
        $complaint->delete();
        return response()->json([
            'delay' => 1500,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id
        ]);
    }

    public function update_complaints(Request $request, $patient_id, $ambulator_id)
    {
        $request->validate([
            'complaint_id' => 'nullable|numeric',
            'complaint_text' => 'required|string',
            'complaint_date' => 'required|date|before:tomorrow',
        ]);
        // dd($request->all());
        $complaint = Complaint::find($request->complaint_id) ?? new Complaint(['ambulator_id' => $ambulator_id]);
        $complaint->fill($request->all())->save();

        $approvement = $complaint->approvement()->firstOrNew([
            "approvable_id" => $complaint->id,
            "approvable_type" => get_class($complaint)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        $response_array = ['success' => __('ambulator.complaint.updated')];
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#ambulator-complaint-section';


        # create
        if (!$request->filled('complaint_id')) {
            return redirect($scroll_to)->withSuccess(__("ambulator.complaint.created"));
        }
        # update
        return response()->json($response_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambulator  $ambulator
     * @return \Illuminate\Http\Response
     */
    public function update(AmbulatorUpdateRequest $request, Patient $patient, Ambulator $ambulator)
    {
        return DB::transaction(function () use ($request, $ambulator) {
            if ($request->has("has_twin")) {
                $ambulator->update([
                    "is_a_twin" => $request->has_twin,
                ]);
            }

            if ($request->has("preliminary_diagnosis") || $request->has("preliminary_diagnosis_disease")) {
                $ambulator->diagnoses()->create([
                    'diagnosis_comment' => $request->preliminary_diagnosis,
                    'disease_id' => $request->preliminary_diagnosis_disease,
                    'type' => 'preliminary',
                    'diagnosis_date' => now(),
                ]);
            }

            if ($request->has("final_diagnosis") || $request->has("final_diagnosis_disease")) {
                $ambulator->diagnoses()->create([
                    'diagnosis_comment' => $request->final_diagnosis,
                    'disease_id' => $request->final_diagnosis_disease,
                    'type' => 'final',
                    'diagnosis_date' => now(),
                ]);
            }

            if ($request->has("complaints")) {
                $ambulator->complaints()->create([
                    "complaint_text" => $request->complaints,
                    "complaint_date" => now(),
                ]);
            }

            if ($request->checkFemaleIssues()) {
                $ambulator->female_issues()->create([
                    "number_of_births" => $request->number_of_births,
                    "number_of_abortions" => $request->number_of_abortions,
                    "date_of_last_birth" => $request->date_of_last_birth,
                    "breastfeeding_complications" => $request->breastfeeding_complications,
                    "breast_inflammation" => $request->breast_inflammation,
                    "menstruation" => $request->menstruation
                ]);
            }

            if ($request->has("tumor_description")) {
                $ambulator->tumor_infos()->create([
                    'tumor_description' => $request->tumor_description,
                    'tumor_date' => now(),
                ]);
            }

            if ($request->has("disease_progression")) {
                $ambulator->onset_and_developments()->create([
                    "oad_comment" => $request->disease_progression,
                    "oad_date" => now(),
                ]);
            }

            return back()->withSuccess(__("ambulator.saved"));
        });
    }

    public function delete_attendances(Request $request, $ambulator_id)
    {
        $request->validate([
            'id' => 'required|numeric|exists:attendances,id',
            'hide_card_id' => 'required|string'
        ]);

        $attendance = Attendance::where([
            ['id', '=', $request->id],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();


        if (!$attendance) {
            return response()->json(['warning' => __('ambulator.ambulator-not-belongs-to-patient')]);
        }

        $attendance->delete();
        Approvement::where('approvable_type', 'App\Models\Attendance')->where('approvable_id', $request->id)->delete();
        return response()->json([
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_card_id,
        ]);
    }

    /**
     * Update part of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambulator  $ambulator
     * @param  \App\Models\Patient  $patients
     * @return \Illuminate\Http\Response
     */
    public function update_attendances(Request $request, $patient_id, $ambulator_id)
    {
        $request->validate([
            'attendance_date' => 'date|required|before:tomorrow',
            'anchor' => 'nullable|string',
            'id' => 'nullable|numeric|exists:attendances,id'
        ]);

        $attendance = Attendance::find($request->id) ??
            new Attendance([
                'ambulator_id' => $ambulator_id,
                // 'patient_id' => $patient_id, // հետագայում արժե ավելացնել patient_id
            ]);
        $attendance->fill($request->all())->save();
        $approvement = $attendance->approvement()->firstOrNew([
            "approvable_id" => $attendance->id,
            "approvable_type" => get_class($attendance)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();
        $ambulator_edit_route = route('patients.ambulator.edit', ['patient' => $patient_id, 'ambulator' => $ambulator_id]);
        $scroll_to = $ambulator_edit_route . '#patient-attendances';
        return redirect($scroll_to)->withSuccess(__("ambulator.saved"));
    }

    # hasOneDiagnosis
    public function delete_diagnosis(Request $request, $ambulator_id)
    {
        $request->validate([
            'diagnosis_id' => 'required|numeric|exists:diagnoses,id',
            'reset_form_id' => 'required|string',
            'reset_fields' => 'required|array',
            'reset_fields.*' => 'nullable|string'
        ]);

        $diagnosis = Diagnosis::where([
            ['id', '=', $request->diagnosis_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();

        if (!$diagnosis) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->reset_form_id
            ]);
        }
        $diagnosis->delete();
        Approvement::where('approvable_type', 'App\Models\Diagnosis')->where('approvable_id', $request->diagnosis_id)->delete();
        return response()->json([
            'success' => __('ambulator.deleted'),
            'data' => $request->all(),
            'diagnosis' => $diagnosis,
            'resetFormId' => $request->reset_form_id,
            'resetFields' => $request->reset_fields
        ]);
    }

    # hasManyDiagnoses
    public function delete_previous_diagnosis(Request $request, $ambulator_id)
    {
        $request->validate([
            'diagnosis_id' => 'required|numeric|exists:diagnoses,id',
            'hide_form_id' => 'required|string'
        ]);

        $previous_diagnosis = Diagnosis::where([
            ['id', '=', $request->diagnosis_id],
            ['user_id', '=', auth()->id()],
            ['ambulator_id', '=', $ambulator_id]
        ])->first();

        if (!$previous_diagnosis) {
            return response()->json([
                'warning' => __('ambulator.ambulator-not-belongs-to-patient'),
                'insertFormId' => $request->hide_form_id
            ]);
        }

        $previous_diagnosis->delete();
        Approvement::where('approvable_type', 'App\Models\Diagnosis')->where('approvable_id', $request->diagnosis_id)->delete();
        return response()->json([
            'delay' => 2000,
            'success' => __('ambulator.deleted'),
            'hideFormId' => $request->hide_form_id,
            'data' => $previous_diagnosis
        ]);
    }

    public function update_diagnosis(Request $request, $patient_id, $ambulator_id)
    {
        $request->validate([
            'diagnosis_date' => 'nullable|date|before:tomorrow',
            'type' => 'required|in:preliminary,final,previous',
            'disease_id' => 'nullable|numeric',
            'diagnosis_comment' => 'nullable|string|max:2000',
            'wrapper_id' => 'nullable|string'
        ]);
        $fillable = $request->only('disease_id', 'diagnosis_date', 'diagnosis_comment');
        // $diagnosis = Diagnosis::find($request->id) ?? - BE CAREFULL, AJAX ??
        // եթե ֆորման չի զրոյացվում այաքսի հարցումից հետո, կրկնակի սեղմելիս էլի կստեղծի մի գրառում
        // քանի որ առաջին անգամ id-ն null է, և այդ արժեքը չի թարմանում առանց ռելոադի։
        // Այդպիսի ֆորմաներ են "նախնական" և "վերջնական" ախտորոշման ֆորմաները ամբուլատորի։
        // Քանի որ "նախկինում ունեցած հիվանդությունների" գրառումն ավելացնելուց հետո ֆորման դատարկվում է,
        // նման խորամանկության անհրաժեշտություն չկա։


        $diagnosis = null;
        $new_diagnosis =  new Diagnosis(['type' => $request->type, 'ambulator_id' => $ambulator_id]);
        if ($request->type === 'previous') {
            $diagnosis =  Diagnosis::find($request->id) ?? $new_diagnosis;
        } else {
            $diagnosis =  Diagnosis::where([
                ['ambulator_id', '=', $ambulator_id],
                ['type', '=', $request->type]
            ])->first() ?? $new_diagnosis;
        }


        $redirect_to = route(
            'patients.ambulator.edit',
            [
                "patient" => $patient_id,
                "ambulator" => $ambulator_id
            ]
        );

        $response_array = ["success" => __("ambulator.saved")];
        if (!$diagnosis->id) {
            if ($request->wrapper_id) {
                $scroll_to = $redirect_to . $request->wrapper_id;
                $response_array['redirectWithHash'] = $scroll_to;
            } else {
                $response_array['redirect'] = $redirect_to;
            }
            $response_array['delay'] = 1500;
        }

        // if anyFilled short
        if (array_filter($fillable)) {
            $diagnosis->fill($fillable)->save();
            $approvement = $diagnosis->approvement()->firstOrNew([
                "approvable_id" => $diagnosis->id,
                "approvable_type" => get_class($diagnosis)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json($response_array);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ambulator  $ambulator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambulator $ambulator)
    {
        //
    }
}
