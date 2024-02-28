<?php

namespace App\Http\Controllers;

use App\Models\Stationary;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\DiseaseList;
use App\Models\MedicineList;
use App\models\Department;
use App\Models\Chamber;
use App\Models\Bed;
use App\Models\TumorTreatmentList;
use App\Models\StageList;
use App\Models\StationaryDiseaseOutcome;
use App\Models\StationaryPrimaryExamination;
use App\Models\StationaryPresentStatus;
use App\Models\StationaryUltrasoundEndoscopy;
use App\Models\StationaryXrayExamination;
use App\Models\StationaryCellularExamination;
use App\Models\StationarySurgeryJustification;
use App\Models\StationarySurgeryProtocol;
use App\Models\StationaryExpertAdvice;
use App\Models\StationaryForAnalysis;
use App\Models\StationarySurgeryDescription;
use App\Models\StationaryDiseaseCourse;
use App\Models\StationaryPrescription;
use App\Models\MeasurementUnit;
use App\Models\StationaryResuscitationDepartment;
use App\Models\StationaryEpicrisis;
use App\Models\StationaryPathologicalAnatomical;
use App\Models\StationaryTreatmentEvaluation;
use App\Models\StationarySpecialNote;
use App\Models\StationaryDiagnosis;
use App\Models\StationarySocialPackage;
use App\Models\Tnm;


use App\Enums\StationaryDeathCircumstanceEnum;
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryDiseaseOutcomeEnum;
use App\Enums\StationaryWorkEfficiencyEnum;
use App\Enums\StationaryAgeTypeEnum;
use App\Enums\StationaryMedicineSideEffectEnum;
use App\Enums\StationarySurgeryEnum;

use App\Enums\StationaryPresentStatus\PositionInBedEnum;
use App\Enums\StationaryPresentStatus\SkinCoveringsEnum;
use App\Enums\StationaryPresentStatus\SubcutaneousFatEnum;
use App\Enums\StationaryPresentStatus\BreathingTypeEnum;
use App\Enums\StationaryPresentStatus\TongueStateEnum;
use App\Enums\StationaryPresentStatus\ActOfAbsorptionEnum;

use App\Enums\StationaryPresentStatus\AbdominalUrinarySymptomEnum;
use App\Enums\StationaryPresentStatus\LiverAndSpleenTypeEnum;
use App\Enums\StationaryPresentStatus\IntestinalPeristalsisEnum;
use App\Enums\StationaryPresentStatus\UrinationTypeEnum;
use App\Enums\StationaryPresentStatus\ExaminationTypeEnum;
use App\Enums\StationaryPresentStatus\UltrasoundableBodyPartEnum;

use App\Enums\StationaryTreatmentEvaluation\EasternCooperativeOncologyGroupEnum;
use App\Enums\StationaryTreatmentEvaluation\KarnofskyPerformanceScaleEnum;
use App\Enums\StationaryTreatmentEvaluation\TreatmentEffectivenessEnum;

use Illuminate\Support\Facades\Gate;

use DB;

use Illuminate\Http\Request;
use App\Http\Requests\Stationary\StationaryPrimaryExaminationRequest as StationaryPERequest;
use App\Http\Requests\Stationary\StationaryUltrasoundEndoscopyRequest;
use App\Http\Requests\Stationary\StationarySurgeryJustificationRequest;
use App\Http\Requests\Stationary\StationarySurgeryProtocolRequest;
use App\Http\Requests\Stationary\StationaryResuscitationDepartmentRequest;
use App\Http\Requests\Stationary\StationaryEpicrisisRequest;

use App\Contracts\Models\HasAttachments;

class StationaryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\Models\HasAttachments  $model
     * @param  \App\Models\Patient  $patient
     * @param  string  $key
     * @param  bool  $multiple
     * @return bool
     */
    private function storeAttachmentsForPatient(Request $request, HasAttachments $model, Patient $patient, string $key = "attachments", bool $multiple = true)
    {
        if (!$request->hasFile($key)) return false;

        $class_name = class_basename(get_class($model));
        $files = $request->file($key);
        $attachments = [];

        if (!$multiple) $files = [$files];

        foreach ($files as $n => $attachment) {
            $attachment_name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME) .  time() . "." . $attachment->getClientOriginalExtension();
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

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $patientStationaries = $patient->stationaries;

        return view("stationary.index")->with(["stationaries" => $patientStationaries, "patient" => $patient]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 15;

        $last_number = Stationary::orderBy('id', 'desc')->first()->number ?? 0;
        $current_number = $last_number + 1;

        $departments = Department::select('id', 'name')->where('has_bads', true)->get()->toArray();
        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $stage_list = StageList::select('name')->get()->toArray();

        $age_type_enums = StationaryAgeTypeEnum::getValues();
        $diseases = DiseaseList::select('id', 'name', 'code')->get()->toArray();
        $medicines = MedicineList::select('id', 'name', 'code')->get()->toArray();

        $tCollectionJson = Tnm::tCollectionJson();
        $nCollectionJson = Tnm::nCollectionJson();
        $mCollectionJson = Tnm::mCollectionJson();

        $gradeCollectionJson = Tnm::gradeCollectionJson();
        $lCollectionJson = Tnm::lCollectionJson();
        $vCollectionJson = Tnm::vCollectionJson();

        $pycmrCollectionJson = Tnm::pycmrCollectionJson();

        return view('stationary.create')->with(compact(
            'tCollectionJson',
            'nCollectionJson',
            'mCollectionJson',

            'gradeCollectionJson',
            'lCollectionJson',
            'vCollectionJson',
            'pycmrCollectionJson',

            "patient",
            "repeatables",
            "current_number",
            "departments",
            "chambers",
            "beds",

            "stage_list",
            "age_type_enums",

            "diseases",
            "medicines"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        // dd($patient);
        // dd($request->all());
        $request->validate([
            'number' => 'nullable|numeric',
            'admission_date' => 'required|date|before:tomorrow',
            'discharge_date' => 'nullable|date|before:tomorrow|after:admission_date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',

            'department_id' => 'nullable|numeric',
            'chamber_id' => 'nullable|numeric', // chamber in db
            "is_paid" => 'nullable|numeric',
            'bed_id' => "nullable|numeric", // bed in db
            'days_qty' => 'nullable|numeric', // der chka

            'by_wheelchair' => 'nullable|boolean',
            // 'tnm' => 'nullable|string',

            'T' => 'nullable|string', //|in:0,1,2,3,4',
            'N' => 'nullable|string', //|in:0,1,2,3,x',
            'M' => 'nullable|string', //|in:0,1,x',

            "Grade" => 'nullable|string',
            "L" => 'nullable|string',
            "V" => 'nullable|string',
            "pycmr" => 'nullable|string',

            'stage' => 'nullable|string',

            // medicine_side_effects
            'side_effect_medicine_id' => 'array', // array of medicine_id
            'side_effect_medicine_comment' => 'array', //  array of medicine_comment

            'age' => 'nullable|numeric',
            'age_type' => 'nullable|in:year,month,day',

            'workplace' => 'nullable|string',
            'profession' => 'nullable|string',

            'from_clinic_id' => 'nullable|numeric',

            'is_urgent' => 'nullable|boolean',
            'from_disease_start' => 'nullable|boolean',
            'hours_later' => 'nullable|numeric',
            'is_planned' => 'nullable|boolean',

            // stationary_diagnoses
            'referring_diagnosis' => 'array',
            'referring_diagnosis_comment' => 'array',

            'admission_diagnosis' => 'array',
            'admission_diagnosis_comment' => 'array',

            'primary_disease_diagnosis_id' => 'nullable|numeric',
            'primary_disease_diagnosis_comment' => 'nullable|string',

            'social_package_id' => 'nullable|numeric|exists:social_packages,id'
        ]);

        return DB::transaction(function () use ($request, $patient) {
            $stationary = $patient->stationaries()->create([
                // 'patient_id' => $patient->id,
                'number' => $request->number,
                'admission_date' => $request->admission_date,
                'discharge_date' => $request->discharge_date,
                'height' => $request->height,
                'weight' => $request->weight,
                'department_id' => $request->department_id,
                'chamber' => $request->chamber_id,  // ուշադիր
                'is_paid' => $request->is_paid,
                'bed' => $request->bed_id,  // ուշադիր
                'days_qty' => $request->days_qty,
                'by_wheelchair' => $request->by_wheelchair,
                'age' => $request->age,
                'age_type' => $request->age_type,
                'clinic_id' => $request->from_clinic_id,
                'is_urgent' => $request->is_urgent,
                'hours_later' => $request->hours_later,
                'is_planned' => $request->is_planned,
                // 'tnm' => $request->tnm,

                'T' => $request->T,
                'N' => $request->N,
                'M' => $request->M,

                "Grade" => $request->Grade,
                "L" => $request->L,
                "V" => $request->V,
                "pycmr" => $request->pycmr,

                'stage' => $request->stage,
                'from_disease_start' => $request->from_disease_start
            ]);

            //medicine_side_effects
            $side_effects = array_slice($request->side_effect_medicine_id, 0, $request->side_effect_medicine_length);
            if (count(array_filter($side_effects))) {
                // $stationary = Stationary::find(2);

                foreach ($side_effects as $key => $side_effect) {
                    if ($side_effect) {
                        $stationary->stationary_medicine_side_effects()->create([
                            "type" => StationaryMedicineSideEffectEnum::intolerance(),
                            'medicine_id' => $side_effect,
                            'medicine_comment' => $request->side_effect_medicine_comment[$key]
                        ]);
                    }
                }
            }

            // head-of-page primary_disease
            if ($request->anyFilled([
                'primary_disease_diagnosis_id',
                'primary_disease_diagnosis_comment'
            ])) {
                $stationary->stationary_diagnoses()->create([
                    'disease_id' => $request->primary_disease_diagnosis_id,
                    'diagnosis_comment' => $request->primary_disease_diagnosis_comment,
                    'diagnosis_type' => StationaryDiagnosisEnum::primary_disease()
                ]);
            }

            // referring_diagnosis
            $referring_diagnosis = array_slice($request->referring_diagnosis, 0, $request->referring_diagnosis_length);
            if (count(array_filter($referring_diagnosis))) {

                foreach ($referring_diagnosis as $key => $referring) {
                    if ($referring) {
                        $stationary->stationary_diagnoses()->create([
                            'disease_id' => $referring,
                            'diagnosis_comment' => $request->referring_diagnosis_comment[$key],
                            'diagnosis_type' => StationaryDiagnosisEnum::referring_institution()
                        ]);
                    }
                }
            }

            // admission_diagnosis
            $admission_diagnosis = array_slice($request->admission_diagnosis, 0, $request->admission_diagnosis_length);
            if (count(array_filter($admission_diagnosis))) {

                foreach ($admission_diagnosis as $key => $admission) {
                    if ($admission) {
                        $stationary->stationary_diagnoses()->create([
                            'disease_id' => $admission,
                            'diagnosis_comment' => $request->admission_diagnosis_comment[$key],
                            'diagnosis_type' => StationaryDiagnosisEnum::admission()
                        ]);
                    }
                }
            }

            if ($request->filled('workplace')) {
                $patient->update([
                    'workplace' => $request->workplace
                ]);
            }

            if ($request->filled('profession')) {
                $patient->update([
                    'profession' => $request->profession
                ]);
            }

            if($request->filled('social_package_id')) {
                $stationary->stationary_social_packages()->create([
                    'social_package_id' => $request->social_package_id
                ]);
            }

            return redirect()->route('patients.show', $patient)->withSuccess(__("stationary.created"));
            // return back()->withSuccess(__("stationary.created"));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  int  $stationary_id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $stationary_id)
    {
//        $patient_id = $patient->id;
//        $stationary = Stationary::find($stationary_id);
//        $m = $stationary->weight;
//        $h = $stationary->height;
//        $hh = $h / 100;
//        $z = $hh * $hh;
//        $mzi = $m / $z;
//        $format = number_format($mzi,2);


        $stationary = $patient->stationaries()->findOrFail($stationary_id);
        $stationary->loadAllRelationsForApprovement();
        $for_pdf = false;


        // $stationary_social_packages = $stationary->stationary_social_packages->last()->social_package_id;
        $stationary_social_packages = StationarySocialPackage::where('id','=', $patient->id)->with('package_item')->get();
        // dd($stationary_social_packages);
        // dd($stationary->toArray());
        return view('stationary.show_page1', compact('patient', 'stationary', 'for_pdf', 'stationary_social_packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Patient $patient, $stationary_id)
    {
        $patient_id = $patient->id;
        $stationary = Stationary::find($patient_id);
        $m = $stationary->weight;
        $h = $stationary->height;
        $hh = $h / 100;
        $z = $hh * $hh;
        $mzi = $m / $z;
        $format = number_format($mzi,2);
        # Tigrani hamar !!!
        // $dc = StationaryDiseaseCourse::first();
        // dd($dc->stationary_prescriptions[0]->measurement_unit->name);
        # Tigrani hamar !!!

        // $this->authorize('stationary-not-belongs-to-patient', [$patient, $stationary]);
        // dd($patient->toArray());
        $part = $request->get('part', 1);
        $stationary = $patient->stationaries()->findOrFail($stationary_id);
        $primary_diagnosis = $stationary->stationary_primary_diagnosis() ??
            new StationaryDiagnosis([
                'diagnosis_type' => StationaryDiagnosisEnum::primary_disease(),
                'disease_id' => null,
                'id' => null,
                'diagnosis_comment' => ''
            ]);

        $death_circumstances_enums = StationaryDeathCircumstanceEnum::getValues();
        $stationary_disease_outcome_enums = StationaryDiseaseOutcomeEnum::getValues();
        $work_efficiency_enums = StationaryWorkEfficiencyEnum::getValues(); // numeric
        $age_type_enums = StationaryAgeTypeEnum::getValues();
        $stage_list = StageList::select('name')->get()->toArray();

        $departments = Department::select('id', 'name')->where('has_bads', true)->get()->toArray();
        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $measurement_units = MeasurementUnit::select('id', 'name')->get();
        // dd($measurement_units);

        $diseases = DiseaseList::select('id', 'name', 'code')->get()->toArray();
        $medicines = MedicineList::select('id', 'name', 'code')->get()->toArray();

        $tt_array = TumorTreatmentList::get()->toArray();
        $tt_collect = collect($tt_array);
        $tt_grouped = $tt_collect->groupBy('type');

        $stationary_array = $stationary->toArray();//dd($stationary_array);
        $stationary_tt = collect($stationary_array["tumor_treatments"])->pluck('id');
        $repeatables = 5;

        $position_in_bed_enum = PositionInBedEnum::getValues();
        $skin_coverings_enum = SkinCoveringsEnum::getValues();
        $subcutaneous_fat_enum = SubcutaneousFatEnum::getValues();
        $breathing_type_enum = BreathingTypeEnum::getValues();
        $tongue_state_enum = TongueStateEnum::getValues();
        $act_of_absorption_enum = ActOfAbsorptionEnum::getValues();
        $abdominal_urinary_symptom_enum = AbdominalUrinarySymptomEnum::getValues();
        $liver_and_spleen_type_enum = LiverAndSpleenTypeEnum::getValues();
        $intestinal_peristalsis_enum = IntestinalPeristalsisEnum::getValues();
        $urination_type_enum = UrinationTypeEnum::getValues();
        $examination_type_enum = ExaminationTypeEnum::getValues();
        $ultrasoundable_body_part_enum = UltrasoundableBodyPartEnum::getValues();
        $examination_program_default_array = StationaryPresentStatus::EXAMINATION_PROGRAM_DEFAULT_ARRAY;

        $eastern_cooperative_oncology_group_enum = EasternCooperativeOncologyGroupEnum::getValues();
        $karnofsky_performance_enum = KarnofskyPerformanceScaleEnum::getValues();
        $treatment_effectiveness_enum = TreatmentEffectivenessEnum::getValues();

        $tCollectionJson = Tnm::tCollectionJson();
        $nCollectionJson = Tnm::nCollectionJson();
        $mCollectionJson = Tnm::mCollectionJson();

        $gradeCollectionJson = Tnm::gradeCollectionJson();
        $lCollectionJson = Tnm::lCollectionJson();
        $vCollectionJson = Tnm::vCollectionJson();
        $pycmrCollectionJson = Tnm::pycmrCollectionJson();

        $user = auth()->user()->getStationaryRelations([
            "stationary_medicine_side_effects",
            "stationary_resuscitation_departments",
            "stationary_ultrasound_endoscopies",
            "stationary_xray_examinations",
            "stationary_cellular_examinations",
            "stationary_for_analysis",
            "stationary_surgery_justifications",
            "stationary_surgery_protocols",
            "stationary_surgery_descriptions",
            "stationary_special_notes",
            "stationary_disease_courses",
            "stationary_diagnoses",
            "stationary_surgeries",
            "stationary_disability_certificates",
            "stationary_expertise_conclusions",
            "stationary_histological_examinations",
            "stationary_social_packages"
        ], $stationary->id);
        // dd($user->toArray());

        $edit_view = 'stationary.edit_before_19';
        if(auth()->user()->hasRole(['receptionist'])) {
            $edit_view = 'stationary.edit_1_9';
        }
        if($part == 2) {
            $edit_view = 'stationary.edit_after_19';
        }

        return view($edit_view)->with(compact(
            'format',
            // return view('stationary.stationary_disease_course')->with(compact(
            'tCollectionJson',
            'nCollectionJson',
            'mCollectionJson',

            'gradeCollectionJson',
            'lCollectionJson',
            'vCollectionJson',
            'pycmrCollectionJson',

            'user',
            'patient',
            'stationary',
            'stationary_array',
            'repeatables',

            'primary_diagnosis',

            'tt_grouped',
            'stationary_tt',

            'stationary_disease_outcome_enums',
            'death_circumstances_enums',
            'work_efficiency_enums',
            'age_type_enums',

            'departments',
            'chambers',
            'beds',
            'stage_list',
            'measurement_units',

            "diseases",
            "medicines",

            // stationary_present_status
            'position_in_bed_enum',
            'skin_coverings_enum',
            'subcutaneous_fat_enum',
            'breathing_type_enum',
            'tongue_state_enum',
            'act_of_absorption_enum',
            'abdominal_urinary_symptom_enum',
            'liver_and_spleen_type_enum',
            'intestinal_peristalsis_enum',
            'urination_type_enum',

            'examination_type_enum',
            'ultrasoundable_body_part_enum',
            'examination_program_default_array',

            // stationary_treatment_evaluation 20
            'eastern_cooperative_oncology_group_enum',
            'karnofsky_performance_enum',
            'treatment_effectiveness_enum'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, Stationary $stationary)
    {
        $request->validate([
            'primary_disease_diagnosis_id' => 'nullable|numeric',
            'primary_disease_diagnosis_comment' => 'nullable|string',

            'T' => 'nullable|string', //|in:0,1,2,3,4',
            'N' => 'nullable|string', //|in:0,1,2,3,x',
            'M' => 'nullable|string', //|in:0,1,x',

            "Grade" => 'nullable|string',
            "L" => 'nullable|string',
            "V" => 'nullable|string',
            "pycmr" => 'nullable|string',

            'stage' => 'nullable|string',

            'admission_date' => 'nullable|date|before:tomorrow',
            'discharge_date' => 'nullable|date|before:tomorrow',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',

            'department_id' => 'nullable|numeric',
            'chamber_id' => 'nullable|numeric', // chamber in db
            "is_paid" => 'nullable|numeric',
            'bed_id' => "nullable|numeric", // bed in db
            'days_qty' => 'nullable|numeric', // der chka

            'by_wheelchair' => 'nullable|boolean',

            // medicine_side_effects
            'side_effect_medicine_id' => 'array', // array of medicine_id
            'side_effect_medicine_comment' => 'array', //  array of medicine_comment


            // start 0-9
            'age' => 'nullable|numeric',
            'age_type' => 'nullable|in:year,month,day',

            'workplace' => 'nullable|string',
            'profession' => 'nullable|string',

            'from_clinic_id' => 'nullable|numeric',

            'is_urgent' => 'nullable|boolean',
            'from_disease_start' => 'nullable|boolean',
            'hours_later' => 'nullable|numeric',
            'is_planned' => 'nullable|boolean',

            'referring_diagnosis' => 'array',
            'referring_diagnosis_comment' => 'array',

            'admission_diagnosis' => 'array',
            'admission_diagnosis_comment' => 'array',

            // start 10-19
            'clinical_diagnosis_id' => 'nullable|numeric',
            'clinical_diagnosis_date' => 'nullable|date|before:tomorrow',
            'clinical_diagnosis_comment' => 'nullable|string',

            'final_clinical_diagnosis_id' => 'nullable|numeric',
            'final_clinical_diagnosis_date' => 'nullable|date|before:tomorrow',
            'final_clinical_diagnosis_comment' => 'nullable|string',

            'underlying_disease_complication_id' => 'nullable|numeric',
            'underlying_disease_complication_comment' => 'nullable|string',

            'concomitant_disease_complication_id' => 'nullable|numeric',
            'concomitant_disease_complication_comment' => 'nullable|string',

            'tuberculosis_complaints_id' => 'nullable|numeric',
            'tuberculosis_complaints_comment'  => 'nullable|string',

            'times_hospitalized' => 'nullable|numeric',

            'surgery_id' => 'nullable|numeric',
            'anesthesia_id' => 'nullable|numeric',
            'surgery_datetime' => 'nullable|date|before:tomorrow',
            'surgery_complication_comment' => 'nullable|string',

            'treatment_other_type_id' => 'nullable|numeric',
            'treatment_other_type_comment' => 'nullable|string',

            'tumor_treatment_id' => 'nullable|array',

            'disability_certificate_number'  => 'nullable|numeric',
            'disability_certificate_from' => 'nullable|date|before:tomorrow',
            'disability_certificate_to' => 'nullable|date|before:tomorrow',


            'disease_outcome_id' => 'nullable|string',
            'disease_outcome_date' => 'nullable|date|before:tomorrow',
            'moved_to_clinic_id' => 'nullable|numeric',
            'death_circumstance_id' => 'nullable|string',

            'workability' => 'nullable|string',
            'workability_comment' => 'nullable|string',

            'expertise_conclusion' => 'nullable|string',

            'histological_result_comment' => 'nullable|string',
            'histological_result_date' => 'nullable|date|before:tomorrow',
            'histological_result_number' => 'nullable|numeric',

            'attending_doctor_id' => 'nullable|numeric',
            'department_head_id' => 'nullable|numeric',
            // end 10-19
        ]);
        // dd($request->all());
        $ch = null;

        // head-part
        if ($request->anyFilled([
            'primary_disease_diagnosis_id',
            'primary_disease_diagnosis_comment'
        ])) {
            $stationary->stationary_diagnoses()->create([
                'disease_id' => $request->primary_disease_diagnosis_id,
                'diagnosis_comment' => $request->primary_disease_diagnosis_comment,
                'diagnosis_type' => StationaryDiagnosisEnum::primary_disease()
            ]);
        }

        if ($request->has('stage')) {
            $stationary->stage = $request->stage;
            $ch = $stationary->save();
        }


        if ($request->has('T')) {
            $stationary->T = $request->T;
            $ch = $stationary->save();
        }
        if ($request->has('N')) {
            $stationary->N = $request->N;
            $ch = $stationary->save();
        }
        if ($request->has('M')) {
            $stationary->M = $request->M;
            $ch = $stationary->save();
        }

        if ($request->has('Grade')) {
            $stationary->Grade = $request->Grade;
            $ch = $stationary->save();
        }
        if ($request->has('L')) {
            $stationary->L = $request->L;
            $ch = $stationary->save();
        }
        if ($request->has('V')) {
            $stationary->V = $request->V;
            $ch = $stationary->save();
        }
        if ($request->has('pycmr')) {
            $stationary->pycmr = $request->pycmr;
            $ch = $stationary->save();
        }

        // before-1-9
        if ($request->has('discharge_date')) {
            $stationary->discharge_date = $request->discharge_date;
            $ch = $stationary->save();
        }
        if ($request->has('admission_date')) {
            $stationary->admission_date = $request->admission_date;
            $ch = $stationary->save();
        }

        if ($request->has('height')) {
            $stationary->height = $request->height;
            $ch = $stationary->save();
        }
        if ($request->has('weight')) {
            $stationary->weight = $request->weight;
            $ch = $stationary->save();
        }

        if ($request->has('department_id')) {
            $stationary->department_id = $request->department_id;
            $ch = $stationary->save();
        }
        if ($request->has('chamber_id')) {
            $stationary->chamber = $request->chamber_id; // chamber in db
            $ch = $stationary->save();
        }
        if ($request->has('is_paid')) {
            $stationary->is_paid = $request->is_paid;
            $ch = $stationary->save();
        }

        if ($request->has('bed_id')) {
            $stationary->bed = $request->bed_id;
            $ch = $stationary->save();
        }
        if ($request->has('days_qty')) {
            $stationary->days_qty = $request->days_qty;
            $ch = $stationary->save();
        }

        if ($request->has('by_wheelchair')) {
            $stationary->by_wheelchair = $request->by_wheelchair;
            $ch = $stationary->save();
        }

        //medicine_side_effects
        if ($request->side_effect_medicine_id && is_array($request->side_effect_medicine_id)) {
            $side_effects = array_slice($request->side_effect_medicine_id, 0, $request->side_effect_medicine_length);
            if (count(array_filter($side_effects))) {
                foreach ($side_effects as $key => $side_effect) {
                    if ($side_effect) {
                        $stationary->stationary_medicine_side_effects()->create([
                            'type' => StationaryMedicineSideEffectEnum::intolerance(),
                            'medicine_id' => $side_effect,
                            'medicine_comment' => $request->side_effect_medicine_comment[$key]
                        ]);
                    }
                }
            }
        }

        // 3. dont use anyFilled here
        if ($request->has('age_type')) {
            $stationary->age_type = $request->age_type;
            $ch = $stationary->save();
        }
        if ($request->has('age')) {
            $stationary->age = $request->age;
            $ch = $stationary->save();
        }

        // 5. patient's workplace|profession
        if ($request->has('workplace')) {
            $patient->workplace = $request->workplace;
            $ch = $patient->save();
        }
        if ($request->has('profession')) {
            $patient->profession = $request->profession;
            $ch = $patient->save();
        }

        // 6.7. saving into stationary
        if ($request->has('from_clinic_id')) {
            $stationary->clinic_id = $request->from_clinic_id; // 6.
            $ch = $stationary->save();
        }
        if ($request->has('is_urgent')) {
            $stationary->is_urgent = $request->is_urgent;
            $ch = $stationary->save();
        }
        if ($request->has('from_disease_start')) {
            $stationary->from_disease_start = $request->from_disease_start;
            $ch = $stationary->save();
        }
        if ($request->has('hours_later')) {
            $stationary->hours_later = $request->hours_later;
            $ch = $stationary->save();
        }
        if ($request->has('is_planned')) {
            $stationary->is_planned = $request->is_planned;
            $ch = $stationary->save();
        }

        // 8. referring_diagnosis
        if ($request->referring_diagnosis && is_array($request->referring_diagnosis)) {
            $referring_diagnosis = array_slice($request->referring_diagnosis, 0, $request->referring_diagnosis_length);
            if (count(array_filter($referring_diagnosis))) {

                foreach ($referring_diagnosis as $key => $referring) {
                    if ($referring) {
                        $ch = $stationary->stationary_diagnoses()->create([
                            'disease_id' => $referring,
                            'diagnosis_comment' => $request->referring_diagnosis_comment[$key],
                            'diagnosis_type' => StationaryDiagnosisEnum::referring_institution()
                        ]);
                    }
                }
            }
        }

        // 9. admission_diagnosis
        if ($request->admission_diagnosis && is_array($request->admission_diagnosis)) {
            $admission_diagnosis = array_slice($request->admission_diagnosis, 0, $request->admission_diagnosis_length);
            if (count(array_filter($admission_diagnosis))) {

                foreach ($admission_diagnosis as $key => $admission) {
                    if ($admission) {
                        $ch = $stationary->stationary_diagnoses()->create([
                            'disease_id' => $admission,
                            'diagnosis_comment' => $request->admission_diagnosis_comment[$key],
                            'diagnosis_type' => StationaryDiagnosisEnum::admission()
                        ]);
                    }
                }
            }
        }

        # 10. Կլինիկական ախտորոշումը՝
        // "clinical_diagnosis_id" => null
        // "clinical_diagnosis_date" => null
        // "clinical_diagnosis_comment" => null
        // <<diagnosis_type>> => StationaryDiagnosisEnum::clinical()

        if ($request->anyFilled([
            'clinical_diagnosis_id',
            'clinical_diagnosis_date',
            'clinical_diagnosis_comment'
        ])) {
            $ch = $stationary->stationary_diagnoses()->create([
                "disease_id" => $request->clinical_diagnosis_id,
                "diagnosis_date" => $request->clinical_diagnosis_date,
                "diagnosis_comment" => $request->clinical_diagnosis_comment,
                "diagnosis_type" => StationaryDiagnosisEnum::clinical(),
            ]);
        }

        # 11.ա) հիմնական՝
        // "final_clinical_diagnosis_id" => null
        // "final_clinical_diagnosis_date" => null
        // "final_clinical_diagnosis_comment" => null
        // <<diagnosis_type>> => StationaryDiagnosisEnum::final_clinical()

        if ($request->anyFilled([
            'final_clinical_diagnosis_id',
            'final_clinical_diagnosis_date',
            'final_clinical_diagnosis_comment'
        ])) {
            $ch = $stationary->stationary_diagnoses()->create([
                "disease_id" => $request->final_clinical_diagnosis_id,
                "diagnosis_date" => $request->final_clinical_diagnosis_date,
                "diagnosis_comment" => $request->final_clinical_diagnosis_comment,
                "diagnosis_type" => StationaryDiagnosisEnum::final_clinical(),
            ]);
        }

        # 11.բ) հիմնական հիվանդության բարդություն՝
        // "underlying_disease_complication_id" => null
        // "underlying_disease_complication_comment" => null
        // << diagnosis_type >> => StationaryDiagnosisEnum::disease_complication()
        if ($request->anyFilled([
            'underlying_disease_complication_id',
            'underlying_disease_complication_comment'
        ])) {
            $ch = $stationary->stationary_diagnoses()->create([
                "disease_id" => $request->underlying_disease_complication_id,
                "diagnosis_comment" => $request->underlying_disease_complication_comment,
                "diagnosis_type" => StationaryDiagnosisEnum::disease_complication(),
            ]);
        }

        # 11.գ) ուղեկցող հիվանդության բարդություն՝
        // "concomitant_disease_complication_id" => null
        // "concomitant_disease_complication_comment" => null
        // << diagnosis_type >> => StationaryDiagnosisEnum::concomitant_disease()
        if ($request->anyFilled([
            'concomitant_disease_complication_id',
            'concomitant_disease_complication_comment'
        ])) {
            $ch = $stationary->stationary_diagnoses()->create([
                "disease_id" => $request->concomitant_disease_complication_id,
                "diagnosis_comment" => $request->concomitant_disease_complication_comment,
                "diagnosis_type" => StationaryDiagnosisEnum::concomitant_disease(),
            ]);
        }

        # 11.դ) տուբերկուլյոզին բնորոշ գանգատներ՝
        // "tuberculosis_complaints_id" => null
        // "tuberculosis_complaints_comment" => null
        // << diagnosis_type >> => StationaryDiagnosisEnum::tuberculosis_complaint()
        if ($request->anyFilled([
            'tuberculosis_complaints_id',
            'tuberculosis_complaints_comment'
        ])) {
            $ch = $stationary->stationary_diagnoses()->create([
                "disease_id" => $request->tuberculosis_complaints_id,
                "diagnosis_comment" => $request->tuberculosis_complaints_comment,
                "diagnosis_type" => StationaryDiagnosisEnum::tuberculosis_complaint(),
            ]);
        }

        # 11.ե) Մալարիայի էնդեմիկ գոտում՝
        // "malaria_endemic_zone" => "0" stationary
        if ($request->filled('malaria_endemic_zone')) {
            $ch = $stationary->update(["malaria_endemic_zone" => $request->malaria_endemic_zone]);
        }

        if ($request->filled('has_tuberculosis_complaints')) {
            $stationary->has_tuberculosis_complaints = $request->has_tuberculosis_complaints;
            $ch = $stationary->save();
        }


        # 12. Տվյալ տարում հոսպիտալացվել է անգամ
        // "times_hospitalized" => "0" - stationary
        if ($request->filled('times_hospitalized')) {
            $ch = $stationary->update(['times_hospitalized' => $request->times_hospitalized]);
        }

        # 13. Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ
        // "surgery_datetime" => null
        // "surgery_id" => null
        // "anesthesia_id" => null
        // "surgery_complication_comment" => null
        // "surgeon_id" => null
        if ($request->anyFilled([
            'surgery_id',
            'anesthesia_id',
            'surgery_datetime',
            'surgery_complication_comment',
            // 'surgeon_id'
        ])) {
            $ch = $stationary->stationary_surgeries()->create([
                "type" => StationarySurgeryEnum::stationary(),
                "surgery_id" => $request->surgery_id,
                "anesthesia_id" => $request->anesthesia_id,
                "surgery_date" => $request->surgery_datetime,
                "complications" => $request->surgery_complication_comment,
                // "surgeon_id" => $request->surgeon_id ??
            ]);
        }

        # 14.1 Բուժման այլ տեսակներ
        // "treatment_other_type_id" => null
        // "treatment_other_type_comment" => null
        if ($request->anyFilled([
            'treatment_other_type_id',
            'treatment_other_type_comment'
        ])) {
            $ch = $stationary->stationary_treatments()->create([
                "treatment_id" => $request->treatment_other_type_id,
                "treatment_comment" => $request->treatment_other_type_comment
            ]);
        }


        # 14.2 Չարորակ նորագոյություններով հիվանդների համար
        // "tumor_treatment_id" => array:3 [▼
        //     0 => "1"
        //     1 => "5"
        //     2 => "7"
        // ]
        if ($request->filled('tumor_treatment_id')) {
            $stationary->tumor_treatments()->detach();
            foreach ($request->tumor_treatment_id as $tumor_treatment_id) {
                $ch = $stationary->tumor_treatments()->attach($tumor_treatment_id);
            }
        }


        # 15. Նշումներ անաշխատունակության թերթիկ տրման մասին
        // "disability_certificate_number" => null
        // "disability_certificate_from" => null
        // "disability_certificate_to" => null
        if ($request->anyFilled([
            'disability_certificate_number',
            'disability_certificate_from',
            'disability_certificate_to'
        ])) {
            $ch = $stationary->stationary_disability_certificates()->create([
                "number" => $request->disability_certificate_number,
                "from" => $request->disability_certificate_from,
                "to" => $request->disability_certificate_to
            ]);
        }

        # 16.1 Հիվանդության ելքը՝
        # դուրս է գրվել՝
        // "disease_outcome_id" => null
        // "disease_outcome_date" => null


        # 16.2 Տեղափոխվել է այլ հաստատություն՝
        # մահացել է՝
        // "moved_to_clinic_id" => null
        // "death_circumstance_id" => null
        if ($request->anyFilled([
            'disease_outcome_id', // ?? set value of enum on front
            'disease_outcome_date',
            'moved_to_clinic_id',
            'death_circumstance_id' // ?? set value of enum on front
        ])) {
            $disease_outcomes = $stationary->stationary_disease_outcomes ?? new StationaryDiseaseOutcome();
            $disease_outcomes->stationary_id = $stationary->id;
            $disease_outcomes->outcome = $request->disease_outcome_id;
            $disease_outcomes->outcome_date = $request->disease_outcome_date;
            $disease_outcomes->transferred_clinic_id = $request->moved_to_clinic_id;
            $disease_outcomes->death_circumstance = $request->death_circumstance_id;

            $ch = $disease_outcomes->save();
        }


        # 17. Աշխատունակությունը՝
        # if "workability" === "5" take "workability_comment"
        // "workability" => "2"
        // "workability_comment" => null ( stationary 2)
        if ($request->anyFilled([
            'workability',
            'workability_comment'
        ])) {
            $work_efficiency_status = null;

            if ($request->filled('workability')) {
                $work_efficiency_status = $request->workability;
            }
            if ($request->filled('workability_comment')) {
                $work_efficiency_status = StationaryWorkEfficiencyEnum::other(); // other
            }

            $ch = $stationary->update([
                'work_efficiency_status' => $work_efficiency_status,
                'work_efficiency_comment' => $request->workability_comment
            ]);
        }


        # 18. Փորձաքննության ընդունվածների համար, եզրակացություն՝
        // "expertise_conclusion" => null
        if ($request->filled('expertise_conclusion')) {
            $ch = $stationary->stationary_expertise_conclusions()->create([
                "conclusion" => $request->expertise_conclusion
            ]);
        }


        # 19. Հյուսվածքաբանական հետազոտության արդյունքը՝
        // "histological_result_date" => null
        // "histological_result_number" => null
        // "histological_result_comment => null\
        if ($request->anyFilled([
            'histological_result_comment',
            'histological_result_date',
            'histological_result_number'
        ])) {
            $ch = $stationary->stationary_histological_examinations()->create([
                "examination" => $request->histological_result_comment,
                "examination_date" => $request->histological_result_date,
                "examination_number" => $request->histological_result_number,
            ]);
        }

        # բուժող բժիշկ || բաժանմունքի վարիչ
        // "attending_doctor_id" => null
        // "department_head_id" => null
        if ($request->filled('attending_doctor_id')) {
            $ch = $stationary->update([
                "attending_doctor_id" => $request->attending_doctor_id
            ]);
        }
        if ($request->filled('department_head_id')) {
            $ch = $stationary->update([
                "department_head_id" => $request->department_head_id
            ]);
        }

        if ($ch) {
            if ($request->ajax()) {
                return response()->json(['success' => __("stationary.changed")]);
            }
            return back()->withSuccess(__("stationary.changed"));
        } else {
            if ($request->ajax()) {
                return response()->json(['success' => __("stationary.nothig_was_changed")]);
            }
            return back()->withSuccess(__("stationary.nothig_was_changed"));
        }
    }

    public function delete_primary_examination(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_primary_examinations,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $primary_examination = StationaryPrimaryExamination::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$primary_examination) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $primary_examination->approvement()->delete();
        $primary_examination->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_primary_examination relation of the specified resource in storage.
     *
     * @param   App\Http\Requests\Stationary\StationaryPrimaryExaminationRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function update_primary_examination(StationaryPERequest $request, Patient $patient, Stationary $stationary)
    {
        return DB::transaction(function () use ($request, $stationary) {
            $primary_examination = $stationary->stationary_primary_examination ?? new StationaryPrimaryExamination;
            $primary_examination->stationary_id = $stationary->id;
            $primary_examination->fill($request->all())->save();

            //Նախկինում տարած ուրիշ հիվանդություններ
            $previous_diseases = array_filter(array_slice($request->previous_disease_ids, 0, $request->previous_diseases_length));
            if (count($previous_diseases)) {
                foreach ($previous_diseases as $key => $disease_id) {
                    $stationary->stationary_diagnoses()->create([
                        "diagnosis_type" => StationaryDiagnosisEnum::previous_disease(),
                        "disease_id" => $disease_id,
                        "diagnosis_comment" => $request->previous_disease_comments[$key],
                    ]);
                }
            }
            // Դեղերի հանդեպ ալերգիկ երևություններ
            $medicine_side_effects = array_filter(array_slice($request->medicine_ids, 0, $request->medicine_side_effects_length));
            if (count($medicine_side_effects)) {
                foreach ($medicine_side_effects as $key => $medicine_id) {
                    $stationary->stationary_medicine_side_effects()->create([
                        "type" => StationaryMedicineSideEffectEnum::allergy(),
                        "medicine_id" => $medicine_id,
                        "medicine_comment" => $request->medicine_side_effect_comments[$key],
                    ]);
                }
            }
            // Վիրահատություններ
            $surgeries = array_filter(array_slice($request->surgery_ids, 0, $request->surgeries_length));
            if (count($surgeries)) {
                foreach ($surgeries as $key => $surgery_id) {
                    $stationary->stationary_surgeries()->create([
                        "type" => StationarySurgeryEnum::stationary_primary_examination(),
                        "surgery_id" => $surgery_id,
                        "complications" => $request->surgery_comments[$key],
                    ]);
                }
            }
            // Վնասակար սովորություններ
            $harmfuls = array_filter(array_slice($request->harmful_ids, 0, $request->harmfuls_length));
            if (count($harmfuls)) {
                foreach ($harmfuls as $key => $harmful_id) {
                    $stationary->stationary_harmfuls()->create([
                        "harmful_id" => $harmful_id,
                        "harmful_comment" => $request->harmful_comments[$key],
                    ]);
                }
            }

            $approvement = $primary_examination->approvement()->firstOrNew([
                "approvable_id" => $primary_examination->id,
                "approvable_type" => get_class($primary_examination)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            if ($request->ajax())
                return response()->json(["success" => __("stationary.changed")]);

            return back()->withSuccess(__("stationary.changed"));
        });
    }

    public function delete_present_status(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_present_statuses,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $present_status = StationaryPresentStatus::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$present_status) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $present_status->approvement()->delete();
        $present_status->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_present_status relation of the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function present_status(Request $request, Patient $patient, Stationary $stationary)
    {

        // 38 columns into "stationary_present_statuses"
        // obesity - we will not use : 37
        // id is increment : 36
        // created_at and updated_at are auto : 34
        // dump($request->other_exam_type_length);
        // dump($request->examination_program);

        $request->validate([
            'user_id' => 'required|numeric',
            'patient_general_condition' => 'nullable|string',
            'by_karnowski_scale' => 'nullable|string',
            'consciousness' => 'nullable|string',
            'position_in_bed' => 'nullable|string',

            'skin_coverings' => 'nullable|string',
            'subcutaneous_fat' => 'nullable|string',
            // 'obesity',
            'varicose_of_lower_extremities' => 'nullable|boolean',
            'varicose_of_lower_extremities_comment' => 'nullable|string',
            'peripheral_edema' => 'nullable|boolean',
            'peripheral_edema_comment' => 'nullable|string',

            'lymph_node' => 'nullable|string',
            'propulsion_system' => 'nullable|string',
            'nervous_system' => 'nullable|string',
            'breasts' => 'nullable|string',

            'respiratory_complaints' => 'nullable|string',
            'breathing_type' => 'nullable|string',
            'lung_collision' => 'nullable|string',
            'listening_breathing' => 'nullable|string',
            'respiratory_movements_frequency_per_minute' => 'nullable|string',

            'cardiovascular_complaints' => 'nullable|string',
            'heart_percutaneous_border' => 'nullable|string',
            'heartbeat' => 'nullable|string',
            'vascular_stroke' => 'nullable|string',
            // 'blood_pressure' => 'nullable|numeric',

            'blood_pressure_systolic' => 'nullable|numeric',
            'blood_pressure_diastolic' => 'nullable|numeric',

            'endocrine_system' => 'nullable|string',
            'lor_organs' => 'nullable|string',

            'digestive_complaints' => 'nullable|string',
            'tongue_state' => 'nullable|string',
            'act_of_absorption' => 'nullable|string',
            'absorption_difficulty_degree' => 'nullable|string',

            'abdomen_is_symmetrical' => 'nullable|boolean',
            'abdomen_is_involved_in_breathing' => 'nullable|boolean',
            'pain_when_touching_abdomen_comment' => 'nullable|string',

            // 5-th page
            'abdominal_urinary_symptom' => 'nullable|string',
            'abdominal_urinary_symptom_comment' => 'nullable|string',
            'liver_is_enlarged' => 'nullable|boolean',
            'liver_size' => 'nullable|numeric',
            'liver_type' => 'nullable|string',
            'spleen_is_enlarged' => 'nullable|boolean',
            'spleen_size' => 'nullable|numeric',
            'spleen_type' => 'nullable|string',
            'intestinal_peristalsis' => 'nullable|string',

            'urogenital_complaints' => 'nullable|string',
            'urination_type' => 'nullable|string',
            'symptom_of_urogenital_distribution' => 'nullable|boolean',
            'symptom_of_urogenital_distribution_comment' => 'nullable|string',

            'status_localis' => 'nullable|string',

            // StationaryDiagnosis::stationary_present_status_preliminary()
            'present_status_preliminary_disease_id' => 'nullable|numeric',
            'present_status_preliminary_diagnosis_type' => 'nullable|string',
            'present_status_preliminary_diagnosis_comment' => 'nullable|string',

            // saved as json
            'examination_program' => 'nullable|array'
        ]);

        $present_status = $stationary->stationary_present_status ?? new StationaryPresentStatus();

        $present_status->stationary_id = $stationary->id;

        $present_status->user_id = $request->user_id;
        $present_status->patient_general_condition = $request->patient_general_condition;
        $present_status->by_karnowski_scale = $request->by_karnowski_scale;
        $present_status->consciousness = $request->consciousness;
        $present_status->position_in_bed = $request->position_in_bed;

        $present_status->skin_coverings = $request->skin_coverings;
        $present_status->subcutaneous_fat = $request->subcutaneous_fat;
        $present_status->varicose_of_lower_extremities = $request->varicose_of_lower_extremities;
        $present_status->varicose_of_lower_extremities_comment = $request->varicose_of_lower_extremities_comment;
        $present_status->peripheral_edema = $request->peripheral_edema;
        $present_status->peripheral_edema_comment = $request->peripheral_edema_comment;

        $present_status->lymph_node = $request->lymph_node;
        $present_status->propulsion_system = $request->propulsion_system;
        $present_status->nervous_system = $request->nervous_system;
        $present_status->breasts = $request->breasts;

        $present_status->respiratory_complaints = $request->respiratory_complaints;
        $present_status->breathing_type = $request->breathing_type;
        $present_status->lung_collision = $request->lung_collision;
        $present_status->listening_breathing = $request->listening_breathing;
        $present_status->respiratory_movements_frequency_per_minute = $request->respiratory_movements_frequency_per_minute;

        $present_status->cardiovascular_complaints = $request->cardiovascular_complaints;
        $present_status->heart_percutaneous_border = $request->heart_percutaneous_border;
        $present_status->heartbeat = $request->heartbeat;
        $present_status->vascular_stroke = $request->vascular_stroke;
        // $present_status->blood_pressure = $request->blood_pressure;

        $present_status->blood_pressure_systolic = $request->blood_pressure_systolic;
        $present_status->blood_pressure_diastolic = $request->blood_pressure_diastolic;

        $present_status->endocrine_system = $request->endocrine_system;
        $present_status->lor_organs = $request->lor_organs;

        $present_status->digestive_complaints = $request->digestive_complaints;
        $present_status->tongue_state = $request->tongue_state;
        $present_status->act_of_absorption = $request->act_of_absorption;
        $present_status->absorption_difficulty_degree = $request->absorption_difficulty_degree;

        $present_status->abdomen_is_symmetrical = $request->abdomen_is_symmetrical;
        $present_status->abdomen_is_involved_in_breathing = $request->abdomen_is_involved_in_breathing;
        $present_status->pain_when_touching_abdomen_comment = $request->pain_when_touching_abdomen_comment;

        // examination_program
        $examination_program = $request->examination_program;
        $other_exam_type_length = $request->other_exam_type_length ?? 1;
        $examination_program_other = array_slice($examination_program['other'], 0, $other_exam_type_length);

        $examination_program['other'] = $examination_program_other;
        $examination_program_collect = collect($examination_program);

        // dump($examination_program_other);
        // dd($examination_program_collect);

        $present_status->examination_program = $examination_program_collect->toJson();
        $present_status->save();

        $approvement = $present_status->approvement()->firstOrNew([
            "approvable_id" => $present_status->id,
            "approvable_type" => get_class($present_status)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return back()->withSuccess(__("stationary.changed"));
    }

    public function delete_ultrasound_endoscopy(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_ultrasound_endoscopies,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $ultrasound_endoscopy = StationaryUltrasoundEndoscopy::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$ultrasound_endoscopy) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $ultrasound_endoscopy->approvement()->delete();
        $ultrasound_endoscopy->delete();

        $attachments = $ultrasound_endoscopy->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_ultrasound_endoscopy relation of the specified resource in storage.
     *
     * @param   \App\Http\Requests\Stationary\StationaryUltrasoundEndoscopyRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function ultrasound_endoscopy(StationaryUltrasoundEndoscopyRequest $request, Patient $patient, Stationary $stationary)
    {
        $data_except = $request->except(["_token", "_method", "attachments"]);
        if (array_filter($data_except)) {

            $us_endoscopy = StationaryUltrasoundEndoscopy::find($request->id) ?? new StationaryUltrasoundEndoscopy(["stationary_id" => $stationary->id]);
            $us_endoscopy->fill($data_except)->save();
            $attachments_saved = $this->storeAttachmentsForPatient($request, $us_endoscopy, $patient);

            $approvement = $us_endoscopy->approvement()->firstOrNew([
                "approvable_id" => $us_endoscopy->id,
                "approvable_type" => get_class($us_endoscopy)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed"), "attachments" => $attachments_saved]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_xray_examination(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_xray_examinations,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $xray_examination = StationaryXrayExamination::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$xray_examination) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $xray_examination->approvement()->delete();
        $xray_examination->delete();

        $attachments = $xray_examination->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_xray_examinations relation of the specified resource in storage.
     *
     * @param   \App\Http\Requests\Stationary\StationaryUltrasoundEndoscopyRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function xray_examination(StationaryUltrasoundEndoscopyRequest $request, Patient $patient, Stationary $stationary)
    {
        // $data = $request->except("attachments");
        $data_except = $request->except(["_token", "_method", "attachments"]);
        if (array_filter($data_except)) {

            $xray_examination = StationaryXrayExamination::find($request->id) ?? new StationaryXrayExamination(["stationary_id" => $stationary->id]);
            $xray_examination->fill($data_except)->save();
            $attachments_saved = $this->storeAttachmentsForPatient($request, $xray_examination, $patient);

            $approvement = $xray_examination->approvement()->firstOrNew([
                "approvable_id" => $xray_examination->id,
                "approvable_type" => get_class($xray_examination)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed"), "attachments" => $attachments_saved]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_cellular_examination(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_cellular_examinations,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $cellular_examination = StationaryCellularExamination::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$cellular_examination) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $cellular_examination->approvement()->delete();
        $cellular_examination->delete();

        $attachments = $cellular_examination->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_cellular_examination relation of the specified resource in storage.
     *
     * @param   \App\Http\Requests\Stationary\StationaryUltrasoundEndoscopyRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function cellular_examination(StationaryUltrasoundEndoscopyRequest $request, Patient $patient, Stationary $stationary)
    {
        // $data = $request->except("attachments");
        $data_except = $request->except(["_token", "_method", "attachments"]);

        if (array_filter($data_except)) {

            $cellular_examination = StationaryCellularExamination::find($request->id) ?? new StationaryCellularExamination(["stationary_id" => $stationary->id]);
            $cellular_examination->fill($data_except)->save();

            $attachments_saved = $this->storeAttachmentsForPatient($request, $cellular_examination, $patient);

            $approvement = $cellular_examination->approvement()->firstOrNew([
                "approvable_id" => $cellular_examination->id,
                "approvable_type" => get_class($cellular_examination)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed"), "attachments" => $attachments_saved]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_expert_advice(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_expert_advice,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $expert_advice = StationaryExpertAdvice::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$expert_advice) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $expert_advice->approvement()->delete();
        $expert_advice->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function expert_advice(Request $request, Patient $patient, Stationary $stationary)
    {
        // has date and comment
        $request->validate([
            'expert_advice_date' => 'nullable|date|before:tomorrow',
            'expert_advice_comment' => 'nullable|string'
        ]);

        $data_only = $request->except(["_token", "_method"]);
        if (array_filter($data_only)) {

            $expert_advice = StationaryExpertAdvice::find($request->id) ??  new StationaryExpertAdvice(["stationary_id" => $stationary->id]);
            $expert_advice->fill($data_only)->save();

            $approvement = $expert_advice->approvement()->firstOrNew([
                "approvable_id" => $expert_advice->id,
                "approvable_type" => get_class($expert_advice)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed")]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_for_analysis(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_for_analyses,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $for_analysis = StationaryForAnalysis::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$for_analysis) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $for_analysis->approvement()->delete();
        $for_analysis->delete();

        $attachments = $for_analysis->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function for_analysis(Request $request, Patient $patient, Stationary $stationary)
    {
        // dd($request->all());
        $request->validate([
            "for_analysis_comment" => "nullable|string",
            "for_analysis_date" => "nullable|date|before:tomorrow",
            "attachments" => "nullable|array|max:10",
            "attachments.*" => "file|max:50000",
            "attachment_comments" => "nullable|array|max:10"
        ]);

        $data_only = $request->only(["for_analysis_comment", "for_analysis_date"]);

        if (array_filter($data_only)) {

            $for_analysis = StationaryForAnalysis::find($request->id) ?? new StationaryForAnalysis(['stationary_id' => $stationary->id]);
            $for_analysis->fill($data_only)->save();

            $this->storeAttachmentsForPatient($request, $for_analysis, $patient);

            $approvement = $for_analysis->approvement()->firstOrNew([
                "approvable_id" => $for_analysis->id,
                "approvable_type" => get_class($for_analysis)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed")]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_surgery_justification(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_surgery_justifications,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $surgery_justification = StationarySurgeryJustification::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$surgery_justification) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $surgery_justification->approvement()->delete();
        $surgery_justification->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_surgery_justifications relation of the specified resource in storage.
     *
     * @param   \App\Http\Requests\Stationary\StationarySurgeryJustificationRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function surgery_justification(StationarySurgeryJustificationRequest $request, Patient $patient, Stationary $stationary)
    {
        $stationary_surgery_justification = StationarySurgeryJustification::find($request->id) ??  new StationarySurgeryJustification(["stationary_id" => $stationary->id]);
        $stationary_surgery_justification->fill($request->all())->save();

        $approvement = $stationary_surgery_justification->approvement()->firstOrNew([
            "approvable_id" => $stationary_surgery_justification->id,
            "approvable_type" => get_class($stationary_surgery_justification)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_surgery_protocol(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_surgery_protocols,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $surgery_protocol = StationarySurgeryProtocol::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$surgery_protocol) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $surgery_protocol->approvement()->delete();
        $surgery_protocol->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_surgery_protocols relation of the specified resource in storage.
     *
     * @param   \App\Http\Requests\Stationary\StationarySurgeryProtocolRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function surgery_protocol(StationarySurgeryProtocolRequest $request, Patient $patient, Stationary $stationary)
    {
        $stationary_surgery_protocol = StationarySurgeryProtocol::find($request->id) ?? new StationarySurgeryProtocol(["stationary_id" => $stationary->id]);
        $stationary_surgery_protocol->fill($request->all())->save();

        $approvement = $stationary_surgery_protocol->approvement()->firstOrNew([
            "approvable_id" => $stationary_surgery_protocol->id,
            "approvable_type" => get_class($stationary_surgery_protocol)
        ]);
        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_surgery_description(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_surgery_descriptions,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $surgery_description = StationarySurgeryDescription::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$surgery_description) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $surgery_description->approvement()->delete();
        $surgery_description->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function surgery_description(Request $request, Patient $patient, Stationary $stationary)
    {
        $request->validate([
            'surgery_description_date' => 'nullable|date|before:tomorrow',
            'surgery_description_comment' => 'nullable|string',
            'surgery_description_surgeon_id' => 'nullable|numeric',
            'surgery_description_assistant_id' => 'nullable|numeric',
            'surgery_description_surgical_sister_id' => 'nullable|numeric'
        ]);

        // return response()->json($request->all());
        $data_only = $request->except(["_token", "_method"]);
        if (array_filter($data_only)) {
            // $surgery_description = $stationary->stationary_surgery_description ?? new StationarySurgeryDescription();
            $surgery_description = StationarySurgeryDescription::find($request->id) ?? new StationarySurgeryDescription();
            $surgery_description->stationary_id = $stationary->id;
            $surgery_description->surgery_description_date = $data_only['surgery_description_date'];
            $surgery_description->surgery_description_comment = $data_only['surgery_description_comment'];
            $surgery_description->surgeon_id = $data_only['surgery_description_surgeon_id'];
            $surgery_description->assistant_id = $data_only['surgery_description_assistant_id'];
            $surgery_description->surgical_sister_id = $data_only['surgery_description_surgical_sister_id'];
            $surgery_description->save();

            $approvement = $surgery_description->approvement()->firstOrNew([
                "approvable_id" => $surgery_description->id,
                "approvable_type" => get_class($surgery_description)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed")]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_disease_course(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_disease_courses,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $disease_course = StationaryDiseaseCourse::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$disease_course) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $disease_course->approvement()->delete();
        $disease_course->stationary_prescriptions()->delete();
        $disease_course->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function disease_course(Request $request, Patient $patient, Stationary $stationary)
    {

        // dd($request->all());
        $request->validate([
            'disease_course_date' => 'nullable|date|before:tomorrow',
            'disease_course_comment' => 'nullable|string',

            'prescription_medicine_id' => 'nullable|array',
            'prescription_medicine_dose' => 'nullable|array',
            'prescription_medicine_measure' => 'nullable|array',
            'prescription_text' => 'nullable|array',
        ]);

        $data_course = $request->only(['disease_course_date', 'disease_course_comment']);
        if (array_filter($data_course)) {
            $disease_course = StationaryDiseaseCourse::find($request->id) ?? new StationaryDiseaseCourse(["stationary_id" => $stationary->id]);
            $disease_course->fill($data_course)->save(); // dont delete !!!

            $prescription_medicine_ids = array_filter(array_slice($request->prescription_medicine_id, 0, $request->prescription_length));
            // dump($prescription_medicine_ids);
            if (count($prescription_medicine_ids)) {
                foreach ($prescription_medicine_ids as $key => $medicine_id) {
                    $prescription_id = $request->prescription_id[$key] ?? null;
                    // dump($prescription_id);
                    $prescription = StationaryPrescription::find($prescription_id) ??
                        new StationaryPrescription([
                            "patient_id" => $patient->id,
                            "stationary_id" => $stationary->id,
                            "user_id" => $disease_course->user_id,
                            "stationary_disease_course_id" => $disease_course->id
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

            $approvement = $disease_course->approvement()->firstOrNew([
                "approvable_id" => $disease_course->id,
                "approvable_type" => get_class($disease_course)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed")]);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    public function delete_resuscitation_department(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_resuscitation_departments,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $resuscitation = StationaryResuscitationDepartment::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$resuscitation) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $resuscitation->approvement()->delete();
        $resuscitation->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_resuscitation_departments relation of the specified resource in storage.
     *
     * @param  \App\Http\Requests\Stationary\StationaryResuscitationDepartmentRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function resuscitation_department(StationaryResuscitationDepartmentRequest $request, Patient $patient, Stationary $stationary)
    {
        $stationary_resuscitation_department = StationaryResuscitationDepartment::find($request->id) ?? new StationaryResuscitationDepartment(["stationary_id" => $stationary->id]);
        $stationary_resuscitation_department->fill($request->all())->save();

        $approvement = $stationary_resuscitation_department->approvement()->firstOrNew([
            "approvable_id" => $stationary_resuscitation_department->id,
            "approvable_type" => get_class($stationary_resuscitation_department)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_epicrisis(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_epicrises,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $epicrisis = StationaryEpicrisis::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$epicrisis) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $epicrisis->approvement()->delete();
        $epicrisis->delete();

        $attachments = $epicrisis->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    /**
     * Update the stationary_epicrisis relation of the specified resource in storage.
     *
     * @param  \App\Http\Requests\Stationary\StationaryEpicrisisRequest  $request
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function epicrisis(StationaryEpicrisisRequest $request, Patient $patient, Stationary $stationary)
    {
        $stationary_epicrisis = $stationary->stationary_epicrisis ?? new StationaryEpicrisis(["stationary_id" => $stationary->id]);
        $stationary_epicrisis->fill($request->except("attachments"))->save();

        $attachments_saved = $this->storeAttachmentsForPatient($request, $stationary_epicrisis, $patient);

        $approvement = $stationary_epicrisis->approvement()->firstOrNew([
            "approvable_id" => $stationary_epicrisis->id,
            "approvable_type" => get_class($stationary_epicrisis)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json(["success" => __("stationary.changed"), "attachments" => $attachments_saved]);
    }

    public function delete_pathological_anatomical(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_pathological_anatomicals,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $path_anatom = StationaryPathologicalAnatomical::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$path_anatom) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $path_anatom->approvement()->delete();
        $path_anatom->delete();

        $attachments = $path_anatom->attachments;

        if ($attachments) {
            foreach ($attachments as $item) {

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function pathological_anatomical(Request $request, Patient $patient, Stationary $stationary)
    {
        $request->validate([
            'autopsy_date' => 'nullable|date|before:tomorrow',
            'autopsy_protocol' => 'nullable|string',
            'cause_of_death' => 'nullable|string',
            'pathological_anatomical_epicrisis' => 'nullable|string',

            "attachments" => "nullable|array|max:10",
            "attachments.*" => "file|max:50000",
        ]);

        if ($request->anyFilled([
            'autopsy_date|before:tomorrow',
            'autopsy_protocol',
            'cause_of_death',
            'pathological_anatomical_epicrisis'
        ])) {

            $data = $request->except('attachments');
            $spa = $stationary->stationary_pathological_anatomical ?? new StationaryPathologicalAnatomical(["stationary_id" => $stationary->id]);
            $spa->fill($data)->save();

            $this->storeAttachmentsForPatient($request, $spa, $patient);

            $approvement = $spa->approvement()->firstOrNew([
                "approvable_id" => $spa->id,
                "approvable_type" => get_class($spa)
            ]);

            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();

            return response()->json(["success" => __("stationary.changed")]);
        }
        return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
    }

    public function delete_treatment_evaluation(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_treatment_evaluations,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $evaluation = StationaryTreatmentEvaluation::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$evaluation) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $evaluation->approvement()->delete();
        $evaluation->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function treatment_evaluation(Request $request, Patient $patient, Stationary $stationary)
    {
        $request->validate([
            'eastern_cooperative_oncology_group' => 'nullable|string',
            'karnofsky_performance' => 'nullable|string',
            'treatment_effectiveness' => 'nullable|string'
        ]);
        $treatment_evaluation = $stationary->stationary_treatment_evaluation
            ?? new StationaryTreatmentEvaluation(["stationary_id" => $stationary->id]);
        $treatment_evaluation->fill($request->all())->save();

        # քանի որ իվենթները չեն ճանաճվում ?? new ClassName() գրելաոճով
        # իվենթների միջի կոդը /trait Approvable/ չի էլ գործարկվում։
        # Այդ պատճառով static::updated-ի կոդը հայտնվել է այստեղ։
        $approvement = $treatment_evaluation->approvement()->firstOrNew([
            "approvable_id" => $treatment_evaluation->id,
            "approvable_type" => get_class($treatment_evaluation)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_special_note(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:stationary_special_notes,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $special_note = StationarySpecialNote::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$special_note) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
        }

        # ջնջում ենք approvement, նոր հենց մոդելը
        $special_note->approvement()->delete();
        $special_note->delete();

        $attachments = $special_note->attachments;
        // dump($attachments);
        // dump(public_path());
        // dump(storage_path());

        if ($attachments) {
            foreach ($attachments as $item) {
                // dump($item->full_path);
                // dump($item->full_path_os);
                // dump($item->real_path_os);

                if (file_exists($item->real_path_os)) {
                    // dump('exists');
                    // unlink($item->real_path_os);
                    $item->delete();
                }
            }
        }


        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function special_note(Request $request, Patient $patient, Stationary $stationary)
    {
        $data = $request->only(['special_note_date', 'special_note_comment']);
        if (array_filter($data)) {

            $special_note = StationarySpecialNote::find($request->id) ?? new StationarySpecialNote(['stationary_id' => $stationary->id]);
            $special_note->fill($data)->save();
            // $special_note = $stationary->stationary_special_note()->create($data);
            //storeAttachmentsForPatient չի ճանաչում հարաբերությամբ $special_note-ը:
            $this->storeAttachmentsForPatient($request, $special_note, $patient);

            # Այդ պատճառով static::updated-ի կոդը հայտնվել է այստեղ։
            $approvement = $special_note->approvement()->firstOrNew([
                "approvable_id" => $special_note->id,
                "approvable_type" => get_class($special_note)
            ]);

            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();


            return response()->json(["success" => __("stationary.changed")]);
        }
        return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stationary  $stationary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stationary $stationary)
    {
        //
    }
}
