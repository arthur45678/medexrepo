<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Stationary;
use App\Models\Approvement;
use App\Models\StationaryDiagnosis;
use App\Models\StationaryDisabiltyCertificate;
use App\Models\StationaryExpertiseConclusion;
use App\Models\StationaryHistologicalExamination;
use App\Models\StationarySurgery;
use App\Models\StationaryMedicineSideEffect;
use App\Models\StationaryTreatment;
use App\Models\StationarySocialPackage;
use Illuminate\Http\Request;

use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationarySurgeryEnum;
use App\Enums\StationaryMedicineSideEffectEnum;
use Illuminate\Support\Facades\Validator;

class StationaryHasManySectionsController extends Controller
{

    public $approvable_diagnosis_types = [
        'clinical',
        'final_clinical',
        'tuberculosis_complaint',
        'concomitant_disease'
    ];

    public $MAP_VALUE = [
        'primary_disease' => 'primary_disease',
        'admission' => 'admission',
        'referring_institution' => 'referring_institution',
        'clinical' => 'clinical',
        'final_clinical' => 'final_clinical',
        'disease_complication' => 'disease_complication',
        'concomitant_disease' => 'concomitant_disease',
        'tuberculosis_complaint' => 'tuberculosis_complaint',
        'previous_disease' => 'previous_disease',
        'stationary_present_status_preliminary' => 'stationary_present_status_preliminary',
    ];


    # update_medicine_side_effects -> was just medicine_side_effects
    public function update_medicine_side_effects(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_medicine_side_effects,id",
            "medicine_id" => "nullable|numeric:exists:medicine_lists,id",
            "medicine_comment" => "nullable|string",

            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $is_approvable = $request->get('is_approvable', false);
        $insert_form_id = $request->get('insert_form_id', null);

        $medicine_side_effect = StationaryMedicineSideEffect::where([
            ['id', '=', $request->id], // + 99
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$medicine_side_effect) {
            return response()->json([
                'warning' => __('stationary.stationary-not-belongs-to-patient'),
                'insertFormId' => $insert_form_id
            ], 200);
        }

        $medicine_side_effect->fill($request->all())->save();
        if ($is_approvable) {
            $approvement = $medicine_side_effect->approvement()->firstOrNew([
                "approvable_id" => $medicine_side_effect->id,
                "approvable_type" => get_class($medicine_side_effect)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_medicine_side_effects(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_medicine_side_effects,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $side_effect = StationaryMedicineSideEffect::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$side_effect) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning'=>'Ստացիոնար քարտի "'. $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։']);
        }

        $side_effect->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    # create - HasManySideEffects (foreach looping):
    #StationaryMedicineSideEffectEnum intolerance|allergy
    public function create_many_medicine_side_effects(Request $request, Patient $patient, Stationary $stationary)
    {
        $sideEffectValues = implode(',', StationaryMedicineSideEffectEnum::getValues());
        $is_approvable = $request->get('is_approvable', false);

        $validator = Validator::make($request->all(), [
            "wrapper_id" => "required|string",
            "is_approvable" => "nullable|boolean",

            "type" => "required|in:{$sideEffectValues}",

            "medicine_length" => "required|numeric",
            "medicine_id" => "array",
            "medicine_comment" => "array",
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }
        // dd($request->all());
        if ($request->medicine_id && is_array($request->medicine_id)) {
            $medicine_ids = array_slice($request->medicine_id, 0, $request->medicine_length);
            if (count(array_filter($medicine_ids))) {

                foreach ($medicine_ids as $key => $medicine_id) {
                    if ($medicine_id) {
                        $side_effect = $stationary->stationary_medicine_side_effects()->create([
                            'type' => $request->type,
                            'medicine_id' => $medicine_id,
                            'medicine_comment' => $request->medicine_comment[$key]
                        ]);

                        if ($is_approvable) {
                            $approvement = $side_effect->approvement()->firstOrNew([
                                "approvable_id" => $side_effect->id,
                                "approvable_type" => get_class($side_effect)
                            ]);
                            $approvement->fill([
                                "status" => 0,
                                "department_id" => auth()->user()->department_id,
                            ])->save();
                        }
                    }
                }

                $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
                $wrapper_id = $request->wrapper_id ?? '#hey-lalaley';
                $scroll_to = $edit_route . $wrapper_id;
                $response_array = [
                    "success" =>  __("stationary.saved"),
                    "redirectWithHash" => $scroll_to,
                ];
                return response()->json($response_array);
            } else {
                return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
            }
        }
    }

    # delete - hasManyDiagnoses and sections (hide form/wrapper/tr)
    public function delete_diagnoses(Request $request)
    {

        // $request->validate([
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_diagnoses,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $diagnosis = StationaryDiagnosis::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$diagnosis) {
            return response()->json([
                'warning' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning'=>'Ստացիոնար քարտի "'. $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։']);
        }

        $diagnosis->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        return response()->json([
            'success' => 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
        // return back()->withSuccess('Ստացիոնար քարտի "'.$request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։');
    }

    # delete - hasOneDiagnosis (reset form)
    public function delete_reset_diagnoses(Request $request, $stationary_id)
    {
        $request->validate([
            'diagnosis_id' => 'required|numeric|exists:stationary_diagnoses,id',
            'reset_form_id' => 'required|string',
            'reset_fields' => 'required|array',
            'reset_fields.*' => 'nullable|string'
        ]);

        $diagnosis = StationaryDiagnosis::where([
            ['id', '=', $request->diagnosis_id],
            ['user_id', '=', auth()->id()],
            ['stationary_id', '=', $stationary_id]
        ])->first();

        if (!$diagnosis) {
            return response()->json([
                'warning' => __('stationary.stationary-not-belongs-to-patient'),
                'insertFormId' => $request->reset_form_id
            ]);
        }

        $diagnosis->delete();
        Approvement::where('approvable_id', $request->diagnosis_id)->delete();
        return response()->json([
            'success' => __('stationary.deleted'),
            'data' => $request->all(),
            'diagnosis' => $diagnosis,
            'resetFormId' => $request->reset_form_id,
            'resetFields' => $request->reset_fields
        ]);
    }

    # create - HasManyDiagnoses (foreach looping)
    public function create_many_diagnoses(Request $request, Patient $patient, Stationary $stationary)
    {
        $diagnosisValues = implode(',', StationaryDiagnosisEnum::getValues());
        $is_approvable = $request->get('is_approvable', false);

        $validator = Validator::make($request->all(), [
            // $request->validate([
            // "id" => "nullable|numeric|exists:stationary_diagnoses,id",  // on create it not exists, but filled
            // "diagnosis_comment" => "nullable|string|max:10000",
            // "diagnosis_date" => "nullable|date|before:tomorrow",
            // "disease_id" => "nullable|numeric|exists:disease_lists,id",

            "wrapper_id" => "required|string",
            "is_approvable" => "nullable|boolean",

            "diagnosis_type" => "required|in:{$diagnosisValues}",

            "diagnosis_length" => "required|numeric",
            "disease_id" => "array",
            "diagnosis_comment" => "array",
            "diagnosis_date" => "nullable|array"
        ]);
        // dd($request->all());

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        if ($request->disease_id && is_array($request->disease_id)) {
            $disease_ids = array_slice($request->disease_id, 0, $request->diagnosis_length);
            if (count(array_filter($disease_ids))) {

                foreach ($disease_ids as $key => $disease_id) {
                    if ($disease_id) {
                        $diagnosis = $stationary->stationary_diagnoses()->create([
                            'disease_id' => $disease_id,
                            'diagnosis_comment' => $request->diagnosis_comment[$key],
                            'diagnosis_type' => $request->diagnosis_type,
                            'diagnosis_date' => $request->diagnosis_date[$key] ?? null
                        ]);

                        if ($is_approvable) {
                            $approvement = $diagnosis->approvement()->firstOrNew([
                                "approvable_id" => $diagnosis->id,
                                "approvable_type" => get_class($diagnosis)
                            ]);
                            $approvement->fill([
                                "status" => 0,
                                "department_id" => auth()->user()->department_id,
                            ])->save();
                        }
                    }
                }

                $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
                $wrapper_id = $request->wrapper_id ?? '#hey-lalaley';
                $scroll_to = $edit_route . $wrapper_id;
                $response_array = [
                    "success" =>  __("stationary.saved"),
                    "redirectWithHash" => $scroll_to,
                ];
                return response()->json($response_array);
            } else {
                return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
            }
        }
    }

    # update-create HasOneDiagnosis
    public function update_diagnosis(Request $request, Patient $patient, Stationary $stationary)
    {
        $diagnosisValues = implode(',', StationaryDiagnosisEnum::getValues());
        $fillable = $request->only('disease_id', 'diagnosis_date', 'diagnosis_comment');

        $request->validate([
            "id" => "nullable|numeric", // |exists:stationary_diagnoses,id on create it not exists
            "diagnosis_comment" => "nullable|string|max:10000",
            "diagnosis_date" => "nullable|date|before:tomorrow",
            "disease_id" => "nullable|numeric|exists:disease_lists,id",

            "diagnosis_type" => "required|in:{$diagnosisValues}",
            "wrapper_id" => "required|string",
            "is_approvable" => "nullable|boolean"
        ]);

        // dd( $patient);
        // dd( $stationary);
        // dd($request->all());

        $diagnosis = StationaryDiagnosis::find($request->id) ??
            new StationaryDiagnosis([
                'stationary_id' => $stationary->id,
                'diagnosis_type' => $request->diagnosis_type
            ]);


        // dd($diagnosis);
        $is_approvable = $request->get('is_approvable', false);
        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $wrapper_id = $request->wrapper_id ?? '#hey-lalaley';
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = ["success" =>  __("stationary.changed")];

        # create
        if (!$request->filled('id')) {
            $response_array['redirectWithHash'] = $scroll_to;
            $response_array['success'] =  __("stationary.saved");
            $response_array['delay'] = 1500;
        }

        if (array_filter($fillable)) {
            $diagnosis->fill($fillable)->save();

            # if is approvable, do make/update approvement row
            if ($is_approvable) {
                $approvement = $diagnosis->approvement()->firstOrNew([
                    "approvable_id" => $diagnosis->id,
                    "approvable_type" => get_class($diagnosis)
                ]);
                $approvement->fill([
                    "status" => 0,
                    "department_id" => auth()->user()->department_id,
                ])->save();
            }

            return response()->json($response_array);
        } else {
            return response()->json(["warning" => __("stationary.warning.fill_at_least_one")]);
        }
    }

    # update HasManyDiagnoses (նախկինում diagnoses)
    public function update_many_diagnoses(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_diagnoses,id",
            "diagnosis_comment" => "nullable|string|max:10000",
            "diagnosis_date" => "nullable|date|before:tomorrow",
            "disease_id" => "nullable|numeric|exists:disease_lists,id",
            "is_approvable" => "nullable|boolean"
        ]);

        $is_approvable = $request->get('is_approvable', false);
        $insert_form_id = $request->get('insert_form_id', null);

        $diagnosis = StationaryDiagnosis::where([
            ['id', '=', $request->id], // + 99
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$diagnosis) {
            return response()->json([
                'warning' => __('stationary.stationary-not-belongs-to-patient'),
                'insertFormId' => $insert_form_id
            ], 200);
        }

        $diagnosis->fill($request->all())->save();
        if ($is_approvable) {
            $approvement = $diagnosis->approvement()->firstOrNew([
                "approvable_id" => $diagnosis->id,
                "approvable_type" => get_class($diagnosis)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }

    # ------------- surgeries ------------- #
    public function delete_surgeries(Request $request)
    {
        // $request->validate([
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_surgeries,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $surgery = StationarySurgery::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$surgery) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $surgery->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
        // return back()->withSuccess($success);
    }

    public function create_surgery(Request $request, Patient $patient, Stationary $stationary)
    {
        $surgeryValues = implode(',', StationarySurgeryEnum::getValues());
        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);

        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_surgeries,id",
            "surgery_id" => "nullable|numeric|exists:surgery_lists,id",
            "surgery_date" => "nullable|date|before:tomorrow",
            "anesthesia_id" => "nullable|numeric|exists:anesthesia_lists,id",
            "complications" => "nullable|string|max:10000",
            "type" => "required|in:{$surgeryValues}",
            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $fillable = $request->only('anesthesia_id', 'surgery_id', 'surgery_date', 'complications', 'type');
        $is_approvable = $request->get('is_approvable', false);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirectWithHash' => $scroll_to
        ];

        if ($request->anyFilled([
            'surgery_id',
            'anesthesia_id',
            'surgery_date',
            'complications',
        ])) {
            $surgery = $stationary->stationary_surgeries()->create($fillable);
            if ($is_approvable) {
                $approvement = $surgery->approvement()->firstOrNew([
                    "approvable_id" => $surgery->id,
                    "approvable_type" => get_class($surgery)
                ]);
                $approvement->fill([
                    "status" => 0,
                    "department_id" => auth()->user()->department_id,
                ])->save();
            }
            return response()->json($response_array);
        } else {
            return response()->json([
                'warning' => __('stationary.warning.fill_at_least_one'),
                'insertFormId' => trim($wrapper_id, '#')
            ], 200);
        }
    }

    public function update_many_surgeries(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_surgeries,id",
            "surgery_id" => "nullable|numeric|exists:surgery_lists,id",
            "surgery_date" => "nullable|date|before:tomorrow",
            "anesthesia_id" => "nullable|numeric|exists:anesthesia_lists,id",
            "complications" => "nullable|string|max:10000",

            "is_approvable" => "nullable|boolean"
        ]);

        $surgery = StationarySurgery::where([
            ['id', '=', $request->id],
            ['user_id', '=', auth()->id()] // +999
        ])->first();
        // $this->authorize("belongs-to-user", $surgery);
        if (!$surgery) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $surgery->fill($request->all())->save();
        $is_approvable = $request->get('is_approvable', false);
        if ($is_approvable) {
            $approvement = $surgery->approvement()->firstOrNew([
                "approvable_id" => $surgery->id,
                "approvable_type" => get_class($surgery)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }

    #-------------- treatments --------------#
    public function delete_other_treatments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_treatments,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $other_treatment = StationaryTreatment::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$other_treatment) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $other_treatment->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function update_other_treatments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_treatments,id",
            'treatment_id' => 'nullable|numeric|exists:treatment_lists,id',
            'treatment_comment' => 'nullable|string',

            'is_approvable' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $other_treatment = StationaryTreatment::where([
            ['id', '=', $request->id], //  + 33
            ['user_id', '=', auth()->id()]
        ])->first();
        if (!$other_treatment) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $other_treatment->fill($request->all())->save();
        $is_approvable = $request->get('is_approvable', false);

        if($is_approvable) {
            $approvement = $other_treatment->approvement()->firstOrNew([
                "approvable_id" => $other_treatment->id,
                "approvable_type" => get_class($other_treatment)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);

    }

    public function create_other_treatment(Request $request, Patient $patient, Stationary $stationary)
    {
        $validator = Validator::make($request->all(), [
            'treatment_id' => 'nullable|numeric|exists:treatment_lists,id',
            'treatment_comment' => 'nullable|string',

            'is_approvable' => 'nullable|boolean',
            'wrapper_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $fillable = $request->only('treatment_id', 'treatment_comment');

        // dd($fillable);
        $is_approvable = $request->get('is_approvable', false);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirectWithHash' => $scroll_to
        ];

        if ($request->anyFilled([
            'treatment_id', 'treatment_comment'
        ])) {

            $other_treatment = $stationary->stationary_treatments()->create($fillable);
            if ($is_approvable) {
                $approvement = $other_treatment->approvement()->firstOrNew([
                    "approvable_id" => $other_treatment->id,
                    "approvable_type" => get_class($other_treatment)
                ]);
                $approvement->fill([
                    "status" => 0,
                    "department_id" => auth()->user()->department_id,
                ])->save();
            }
            return response()->json($response_array);
        } else {
            return response()->json([
                'warning' => __('stationary.warning.fill_at_least_one'),
                'insertFormId' => trim($wrapper_id, '#')
            ], 200);
        }
    }

    public function create_social_package(Request $request, Patient $patient, Stationary $stationary)
    {
        $validator = Validator::make($request->all(), [
            'social_package_id' => 'required|numeric|exists:social_packages,id',
            'wrapper_id' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirectWithHash' => $scroll_to
        ];

        $fillable = $request->only('social_package_id');
        $stationary->stationary_social_packages()->create($fillable);
        return response()->json($response_array, 201);

    }

    public function update_social_packages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_social_packages,id",
            'social_package_id' => 'required|numeric|exists:social_packages,id',
            'is_approvable' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $social_package = StationarySocialPackage::where([
            ['id', '=', $request->id], //  + 33
            ['user_id', '=', auth()->id()]
        ])->first();
        if (!$social_package) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $social_package->fill($request->all())->save();
        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_social_packages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_social_packages,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $social_package = StationarySocialPackage::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$social_package) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $social_package->delete();
        // Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function delete_disability_certificates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_disabilty_certificates,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $certificate = StationaryDisabiltyCertificate::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$certificate) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $certificate->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function create_disability_certificate(Request $request, Patient $patient, Stationary $stationary)
    {
        $validator = Validator::make($request->all(), [
            "number" => "nullable|numeric", // |max:1000000
            "from" => "nullable|date|before:tomorrow",
            "to" => "nullable|date",

            "wrapper_id" => "required|string",
            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $fillable = $request->only('number', 'from', 'to');

        // dd($fillable);
        $is_approvable = $request->get('is_approvable', false);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirectWithHash' => $scroll_to
        ];

        if ($request->anyFilled([
            'number', 'from', 'to'
        ])) {

            $certificate = $stationary->stationary_disability_certificates()->create($fillable);
            if ($is_approvable) {
                $approvement = $certificate->approvement()->firstOrNew([
                    "approvable_id" => $certificate->id,
                    "approvable_type" => get_class($certificate)
                ]);
                $approvement->fill([
                    "status" => 0,
                    "department_id" => auth()->user()->department_id,
                ])->save();
            }
            return response()->json($response_array);
        } else {
            return response()->json([
                'warning' => __('stationary.warning.fill_at_least_one'),
                'insertFormId' => trim($wrapper_id, '#')
            ], 200);
        }
    }

    /**
     * Update the specified stationary_disability_certificates relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_disability_certificates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_disabilty_certificates,id",
            "number" => "nullable|numeric", // |max:1000000
            "from" => "nullable|date|before:tomorrow",
            "to" => "nullable|date",

            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $certificate = StationaryDisabiltyCertificate::where([
            ['id', '=', $request->id],
            ['user_id','=', auth()->id()]
        ])->first();
        // $this->authorize("belongs-to-user", $certificate);

        if (!$certificate) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $certificate->fill($request->all())->save();
        $is_approvable = $request->get('is_approvable', false);

        if($is_approvable) {
            $approvement = $certificate->approvement()->firstOrNew([
                "approvable_id" => $certificate->id,
                "approvable_type" => get_class($certificate)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }

    public function delete_expertise_conclusions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_expertise_conclusions,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $conclusion = StationaryExpertiseConclusion::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$conclusion) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $conclusion->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }

    public function create_expertise_conclusion(Request $request, Patient $patient, Stationary $stationary)
    {
        $validator = Validator::make($request->all(), [
            "conclusion" => "nullable|string", // |max:10000

            "wrapper_id" => "required|string",
            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $fillable = $request->only('conclusion');

        // dd($fillable);
        $is_approvable = $request->get('is_approvable', false);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirectWithHash' => $scroll_to
        ];

        if ($request->filled('conclusion')) {
            $expertise_conclusion = $stationary->stationary_expertise_conclusions()->create($fillable);
            if ($is_approvable) {
                $approvement = $expertise_conclusion->approvement()->firstOrNew([
                    "approvable_id" => $expertise_conclusion->id,
                    "approvable_type" => get_class($expertise_conclusion)
                ]);
                $approvement->fill([
                    "status" => 0,
                    "department_id" => auth()->user()->department_id,
                ])->save();
            }
            return response()->json($response_array);
        } else {
            return response()->json([
                'warning' => __('stationary.warning.fill_at_least_one'),
                'insertFormId' => trim($wrapper_id, '#')
            ], 200);
        }
    }

    /**
     * Update the specified stationary_expertise_conclusions relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_expertise_conclusions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_expertise_conclusions,id",
            "conclusion" => "nullable|string", // |max:10000

            "is_approvable" => "nullable|boolean"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $conclusion = StationaryExpertiseConclusion::where([
            ['id', '=', $request->id],
            ['user_id','=', auth()->id()]
        ])->first();
        // $this->authorize("belongs-to-user", $conclusion);

        if (!$conclusion) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $conclusion->fill($request->all())->save();
        $is_approvable = $request->get('is_approvable', false);

        if($is_approvable) {
            $approvement = $conclusion->approvement()->firstOrNew([
                "approvable_id" => $conclusion->id,
                "approvable_type" => get_class($conclusion)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }


    public function delete_histological_examinations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:stationary_histological_examinations,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $histological = StationaryHistologicalExamination::where([
            ['id', '=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if (!$histological) {
            $warning = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։';
            return response()->json([
                'warning' => $warning,
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning' => $warning]);
        }

        $histological->delete();
        Approvement::where('approvable_id', $request->id)->delete();

        $success = 'Ստացիոնար քարտի "' . $request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։';
        return response()->json([
            'success' => $success,
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
    }


    public function create_histological_examination(Request $request, Patient $patient, Stationary $stationary)
    {
        $edit_route = route('patients.stationary.edit', ["patient" => $patient, "stationary" => $stationary]);
        $fillable = $request->only('examination_number', 'examination_date', 'examination');

        $validator = Validator::make($request->all(), [
            'examination' => 'nullable|string', // comment
            'examination_date' => 'required|date|before:tomorrow',
            'examination_number' => 'required|numeric',

            'wrapper_id' => 'required|string',
            'is_approvable' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $is_approvable = $request->get('is_approvable', false);
        $wrapper_id = $request->get('wrapper_id', null);
        $scroll_to = $edit_route . $wrapper_id;
        $response_array = [
            "success" =>  __("stationary.saved"),
            'redirect' => $scroll_to
        ];

        // if ($request->anyFilled($fillable)) {} else {
        //     return response()->json([
        //         'warning' => __('stationary.warning.fill_at_least_one'),
        //         'insertFormId' => trim($wrapper_id, '#')
        //     ], 200);
        // }

        // return response()->json(['fillable' => $fillable], 200);
        $histological = $stationary->stationary_histological_examinations()->create($fillable);

        if ($is_approvable) {
            $approvement = $histological->approvement()->firstOrNew([
                "approvable_id" => $histological->id,
                "approvable_type" => get_class($histological)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }
        return response()->json($response_array);
    }

    public function update_histological_examinations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "nullable|numeric|exists:stationary_histological_examinations,id",
            "examination" => "nullable|string|max:10000",
            "examination_number" => "nullable|numeric|max:1000000",
            "examination_date" => "nullable|date|before:tomorrow",

            "is_approvable" => "nullable|boolean"
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401);
        }

        $examination = StationaryHistologicalExamination::where([
            ['id', '=', $request->id], //  + 33
            ['user_id', '=', auth()->id()]
        ])->first();
        // $this->authorize("belongs-to-user", $examination);
        if (!$examination) {
            return response()->json(['warning' => __('stationary.stationary-not-belongs-to-patient')]);
        }

        $examination->fill($request->all())->save();
        $is_approvable = $request->get('is_approvable', false);

        if($is_approvable) {
            $approvement = $examination->approvement()->firstOrNew([
                "approvable_id" => $examination->id,
                "approvable_type" => get_class($examination)
            ]);
            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        }

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Patient $patient
     * @param int $stationary
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient, $stationary)
    {
        $stationaryWithRelations = $patient->stationaries()->findOrFail($stationary);

        $stationaryWithRelations->loadAllRelationsForApprovement();

        // dd($stationaryWithRelations->toArray());

        return view("stationary.relations")->with(["patient" => $patient, "stationary" => $stationaryWithRelations]);
    }

    public function index2(Patient $patient, $stationary)
    {
        $stationaryWithRelations = $patient->stationaries()->find($stationary);

        $stationaryWithRelations->loadAllRelationsForApprovement();

        // dd($stationaryWithRelations);

        return view("stationary.relations2")->with(["patient" => $patient, "stationary" => $stationaryWithRelations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
