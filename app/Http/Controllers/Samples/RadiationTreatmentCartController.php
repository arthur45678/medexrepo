<?php

namespace App\Http\Controllers\Samples;

use App\Enums\Samples\SampleTreatmentsEnum;
use App\Enums\StationaryAgeTypeEnum;
use App\Enums\StationaryDiagnosisEnum;
use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Chamber;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\DiseaseList;
use App\Models\MedicineList;
use App\Models\Samples\RadiationTreatmentCard;
use App\Models\Patient;
use App\Models\Samples\RadiationTreatmentNotes;
use App\Models\Samples\RadiationTreatmentPlan;
use App\Models\Samples\SampleDiagnose;
use App\Models\Samples\SampleTreatments;
use App\Models\StageList;
use App\Models\Stationary;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\RadiationTreatmentExaminationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RadiationTreatmentCartController extends Controller
{

    public function index(Patient $patient)
    {

        $patientRadiationTreatmentCarts = $patient->radiation_treatment_cart;

        return view("samples.radiation_treatment_card.index")->with(['patient' => $patient,
            'patientRadiationTreatmentCarts' => $patientRadiationTreatmentCarts]);

    }

    public function getCards($patient_id, $card_id)
    {

       // $request->session()->forget('radiationTreatment');
        Session::forget('radiationTreatment');
        $cards = RadiationTreatmentCart::paginate(20);
        dd($cards);

        return view("samples.radiation_treatment_card.index")->with();

    }


    public function create(Patient $patient)
    {

        $clinics = Clinic::get();
        $disease_list_get = DiseaseList::get();
        $disease_list = $disease_list_get->slice(0, 50);
        $repeatables = 5;


        $last_number = Stationary::orderBy('id', 'desc')->first()->number ?? 0;
        $current_number = $last_number + 1;
        $medicine_list = MedicineList::get();

        $departments = Department::select('id', 'name')->where('has_bads', true)->get()->toArray();
        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $stage_list = StageList::select('name')->get()->toArray();

        $age_type_enums = StationaryAgeTypeEnum::getValues();
        $stationaries = $patient->stationaries()->get();


        return view("samples.radiation_treatment_card.create")->with(compact(
            "patient",
            "clinics",
            "disease_list",
            "repeatables",
            "current_number",
            "medicine_list",
            "departments",
            "chambers",
            "beds",

            "stage_list",
            "age_type_enums",
            "stationaries",

        ));
    }



    public function postCreate(Request $request, $patient_id)
    {
        $validatedData = $request->validate([
            'patomorph_diagnosis' => 'array',
            'patomorph_diagnosis_comment' => 'array',
            'chemotherapy_medicine' => 'array',
            'chemotherapy_medicine_comment' => 'array',
            'radiation_treatment_at' => 'nullable|date|before:tomorrow',
        ]);

        $patient = Patient::findOrFail($patient_id);
        $radiationCard = new RadiationTreatmentCart();
        //dd($request->all());
        if(empty($request->session()->get('radiationTreatment')) || $request->session()->get('radiationTreatment')->count() == 0){

            //$radiationCard = $patient->radiation_treatment_cart()->create($input);

            $radiationCard = $radiationCard->storeData($request, $patient_id);

            $radiationCard->storePatomorphDiagnoses($request);
            $radiationCard->storeChemTerapies($request);

            $request->session()->put('radiationTreatment', $radiationCard);
        }else{

            $radiationCard = $request->session()->get('radiationTreatment');
            //  $radiationCard = $patient->radiation_treatment_cart()->update($input);
            $radiationCard->updateData($request, $radiationCard->id);

        }

        $patient_id = $patient->id;
        $card_id = $radiationCard->id;


        $radiationCard->storePatomorphDiagnoses($request);


        return redirect()->route('samples.radiation-treatment-createStep2', compact('patient_id','card_id'));
        // return response()->json(['success' => __('samples.created')]);
    }

    public function postUpdate(Request $request, $patient_id, $card_id)
    {

    }




    public function createStep2(Request $request, $patient_id, $card_id)
    {

        $patient = Patient::findOrFail($patient_id);
        $radiationCard = RadiationTreatmentCart::find($card_id);
        $repeatables = 5;

        //$card_id = $radiationCard->id;
        return view("samples.radiation_treatment_card.createStep2")->with(['patient' => $patient, 'radiationCard' => $radiationCard, 'repeatables' => $repeatables]);

    }

    public function postcreateStep2(Request $request, $patient_id,$card_id)
    {

        $validatedData = $request->validate([

        ]);

        $patient = Patient::findOrFail($patient_id);

        $radiationCard= RadiationTreatmentCart::findOrFail($card_id);
        if(empty($request->session()->get('radiationTreatment')) || $request->session()->get('radiationTreatment')->count() == 0){
          //  $radiationCard = RadiationTreatmentCart::updateData($request);


            $request->session()->put('radiationTreatment', $radiationCard);
        }else{
            $radiationCard->storeConcomitantTreatment($request);
            //  dd($request->session()->get('radiationTreatment')->count());
            $radiationTreatment = $request->session()->get('radiationTreatment');
            $request->session()->put('radiationTreatment', $radiationTreatment);

            //  $radiationCard = $patient->radiation_treatment_cart()->update($request->all());
           // $radiationCard = RadiationTreatmentCart::updateData($request, $card_id);

           // $radiationCard = RadiationTreatmentPlan::storeData($request, $card_id);
            $radiationTreatmentPlan = RadiationTreatmentPlan::storeData($request,$card_id);

            $radiationCard->updateData($request, $card_id);



        }

        $patient_id = $patient->id;
        $card_id = $radiationCard->id;
        return redirect()->route('samples.radiation-treatment-createStep3', compact('patient_id','card_id'));
    }


    public function updateStep2(Request $request, $patient_id,$card_id)
    {

    }

    public function createStep3(Request $request, $patient_id,$card_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $radiationCard = RadiationTreatmentCart::findOrFail($card_id);
        return view("samples.radiation_treatment_card.createStep3")->with(['patient' => $patient,'radiationCard' => $radiationCard]);

    }


    public function postcreateStep3(Request $request, $patient_id,$card_id)
    {


        $validatedData = $request->validate([
            'radiation_therapy_date' => 'nullable|date|before:tomorrow',

        ]);
        $radiationCard = new RadiationTreatmentCart();

        $patient = Patient::findOrFail($patient_id);
        if(empty($request->session()->get('radiationTreatment')) || $request->session()->get('radiationTreatment')->count() == 0){
            $radiationCard = $radiationCard->updateData($request);

            $request->session()->put('radiationTreatment', $radiationCard);
        }else{
            $radiationCard = $request->session()->get('radiationTreatment');
            $request->session()->put('radiationTreatment', $radiationCard);

            $radiationCard->updateData($request, $card_id);
        }

        return redirect()->route('samples.radiation-treatment-createStep4', compact('patient_id','card_id'));

    }

    public function postUpdateStep3(Request $request, $patient_id,$card_id)
    {

    }


    public function createStep4(Request $request, $patient_id,$card_id)
    {

        $patient = Patient::findOrFail($patient_id);
        $radiationCard = RadiationTreatmentCart::findOrFail($card_id);
        // $card_id = $radiationCard->id;
        return view("samples.radiation_treatment_card.createStep4")->with(['patient' => $patient,'radiationCard' => $radiationCard]);

    }

    public function postcreateStep4(Request $request, $patient_id,$card_id)
    {
        $validatedData = $request->validate([

        ]);
        $patient = Patient::findOrFail($patient_id);
        $radiationCard = new RadiationTreatmentCart();
        if(empty($request->session()->get('radiationTreatment')) || $request->session()->get('radiationTreatment')->count() == 0){
            //$radiationCard = RadiationTreatmentCart::updateData($request);

            $radiationCard = $radiationCard->updateData($request, $patient_id, $card_id);

            $request->session()->put('radiationTreatment', $radiationCard);
        }else{
            $radiationCard = $request->session()->get('radiationTreatment');
            $request->session()->put('radiationTreatment', $radiationCard);

            $radiationCard = $radiationCard->updateData($request,$card_id);
        }

        $patient_id = $patient->id;
        $card_id = $radiationCard->id;

        return redirect()->route('patients.show',compact('patient'))->with(["success" => 'Պահպանվեց']);

     //   return response()->json(["success" => 'Պահպանվեց']);

    }

    public function postUpdateStep4(Request $request, $patient_id,$card_id)
    {

    }






    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Samples\RadiationTreatmentExaminationRequest
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient, $card_id)
    {
        $radiationCard = new RadiationTreatmentCart();

        $radiationCard = $radiationCard->updateData($request, $card_id);


        /* $s1 = RadiationTreatmentCart::store_1_7($request);
         dd($s1);*/

        $requestData_rad_treatment_cart = $request->only(['user_id','patient_id','attending_doctor_id','diagnose_id',
            'diagnose_text','patomorph_diagnose_id','patomorph_diagnose_text','concomitant_diseases_id','concomitant diseases',
            'treatment_previously_received_diseases_id','treatment_at','treatment_previously_received','','','','','','','',
        ]);

        // $patient->radiation_treatment_cart()->create($request->all());
        //    return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *  @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\RadiationTreatmentCart  $radiationTreatmentCart
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id,$card_id)
    {

        $patient = Patient::findOrFail($patient_id);
        $clinics = Clinic::get();
        $disease_list_get = DiseaseList::get();
        $disease_list = $disease_list_get->slice(0, 50);
        $repeatables = 5;


        $last_number = Stationary::orderBy('id', 'desc')->first()->number ?? 0;
        $current_number = $last_number + 1;
        $medicine_list = MedicineList::get();

        $departments = Department::select('id', 'name')->where('has_bads', true)->get()->toArray();
        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $stage_list = StageList::select('name')->get()->toArray();

        $age_type_enums = StationaryAgeTypeEnum::getValues();
        $stationaries = $patient->stationaries()->get();

        $cart = RadiationTreatmentCart::findOrFail($card_id);


        return view("samples.radiation_treatment_card.show")->with(compact([
            "patient",
            "clinics",
            "disease_list",
            "repeatables",
            "current_number",
            "medicine_list",
            "departments",
            "chambers",
            "beds",

            "stage_list",
            "age_type_enums",
            "stationaries",

        ]));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\RadiationTreatmentCart  $radiationTreatmentCart
     * @return \Illuminate\Http\Response
     */
    public function edit($patient_id,$card_id)
    {


        $patient = Patient::findOrFail($patient_id);

        $radiationCard = $patient->radiation_treatment_cart()->findOrFail($card_id);
        $this->authorize("belongs-to-user", $radiationCard);



        $patomorph_diseasies = SampleDiagnose::getPatomorphDiseasies($radiationCard->id);
        $concomitant_treatments = SampleTreatments::getConcomitantTreatments($radiationCard->id);

        $clinics = Clinic::get();
        $disease_list_get = DiseaseList::get();
        $disease_list = $disease_list_get->slice(0, 50);
        $repeatables = 5;

        $last_number = Stationary::orderBy('id', 'desc')->first()->number ?? 0;
        $current_number = $last_number + 1;
        $medicine_list = MedicineList::get();

        $departments = Department::select('id', 'name')->where('has_bads', true)->get()->toArray();
        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $stage_list = StageList::select('name')->get()->toArray();

        $age_type_enums = StationaryAgeTypeEnum::getValues();
        $stationaries = $patient->stationaries()->get();


        return view("samples.radiation_treatment_card.edit")->with(compact([
            "radiationCard",
            "patient",
            "clinics",
            "disease_list",
            "repeatables",
            "current_number",
            "medicine_list",
            "departments",
            "chambers",
            "beds",
            "patomorph_diseasies",
            "concomitant_treatments",
            "stage_list",
            "age_type_enums",
            "stationaries",

        ]));

        return view("samples.radiation_treatment_card.edit")->with(compact('patient', 'em'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Samples\RadiationTreatmentCart  $radiationTreatmentCart
     * @param  \App\Models\Patient  $patient
     * @param  int $um_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Patient $patient, RadiationTreatmentCart $radiation_treatment_cart)
    {

        $request->validate([
           /* 'disease_course_date' => 'nullable|date|before:tomorrow',
            'disease_course_comment' => 'nullable|string',
            'prescription_medicine_id' => 'nullable|array',*/

            'swelling_place' => 'nullable|string',
            'course_root' => 'nullable|string',
            'course_amoqich' => 'nullable|string',
            'course_ojandak' => 'nullable|string',
            'course_nerardyunavet' => 'nullable|string',
            'radiation_treatment_at' => 'nullable|date|before:tomorrow',
            'radiation_therapy_date' => 'nullable|date|before:tomorrow',


        ]);

        // 6 Նախկինում ստատցած բուժումը
        if ($request->filled('radiation_treatment_at')) {
            $stationary->radiation_treatment_at = $request->radiation_treatment_at;
            $ch = $stationary->save();
        }

        //7․ ՈՒռուցքի տեղակայումը - (ՈՒԱԾ - տեղակայումը, ձևը, չափերը, խորությունը)
        $ch = null;
        if ($request->filled('swelling_place')) {
            $radiation_treatment_cart->swelling_place = $request->swelling_place;
            $ch = $radiation_treatment_cart->save();
        }


//8․ Կուրսը՝
        if ($request->filled('course_root')) {
            $radiation_treatment_cart->swelling_place = $request->course_root;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('swelling_place')) {
            $radiation_treatment_cart->swelling_place = $request->course_amoqich;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('course_ojandak')) {
            $radiation_treatment_cart->course_ojandak = $request->course_ojandak;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('course_nerardyunavet')) {
            $radiation_treatment_cart->course_nerardyunavet = $request->course_nerardyunavet;
            $ch = $radiation_treatment_cart->save();
        }

        //9․ Դոզավորումը՝
        if ($request->filled('dosage_standart')) {
            $radiation_treatment_cart->dosage_standart = $request->dosage_standart;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('dosage_mult')) {
            $radiation_treatment_cart->dosage_mult = $request->dosage_mult;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('dosage_escal')) {
            $radiation_treatment_cart->dosage_escal = $request->dosage_escal;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('dosage_big')) {
            $radiation_treatment_cart->dosage_big = $request->dosage_big;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('dosage_description')) {
            $radiation_treatment_cart->dosage_description = $request->dosage_description;
            $ch = $radiation_treatment_cart->save();
        }

        //10․ Հիվանդի դիրքը
        if ($request->filled('pationt_position_on_the_back')) {
            $radiation_treatment_cart->pationt_position_on_the_back = $request->pationt_position_on_the_back;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('pationt_position_on_the_abdomen')) {
            $radiation_treatment_cart->pationt_position_on_the_abdomen = $request->pationt_position_on_the_abdomen;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('pationt_position_description')) {
            $radiation_treatment_cart->pationt_position_description = $request->pationt_position_description;
            $ch = $radiation_treatment_cart->save();
        }

        //11․ ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները,
        if ($request->filled('ctv_1')) {
            $radiation_treatment_cart->ctv_1 = $request->ctv_1;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('ctv_2')) {
            $radiation_treatment_cart->ctv_2 = $request->ctv_2;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('ctv_3')) {
            $radiation_treatment_cart->ctv_3 = $request->ctv_3;
            $ch = $radiation_treatment_cart->save();
        }

        //12․ Բժիշկ ֆիզիկոս


        //15․Ճառագայթահարման օրագիր
        if ($request->filled('radiation_therapy_date')) {
            $stationary->radiation_therapy_date = $request->radiation_therapy_date;
            $ch = $stationary->save();
        }
        //16.
       // $fields['radiation_reaction_no'] = $request->has('radiation_reaction_no');

        $radiation_treatment_cart->radiation_reaction_no = $request->has('radiation_reaction_no');
        $radiation_treatment_cart->radiation_reaction_local = $request->has('radiation_reaction_local');
        $radiation_treatment_cart->radiation_reaction_hemolog = $request->has('radiation_reaction_hemolog');
        $radiation_treatment_cart->radiation_reaction_basic = $request->has('radiation_reaction_basic');

      //  $radiation_treatment_cart->radiation_reaction_level = $request->has('radiation_reaction_level');


        $radiation_treatment_cart->radiation_reaction_level  = $request->has('radiation_reaction_level');
        if ($request->filled('radiation_reaction_level')) {
            $radiation_treatment_cart->radiation_reaction_level = $request->radiation_reaction_level;
            $ch = $radiation_treatment_cart->save();
        }



        //17․ Բուժման արդյունքը
        $radiation_treatment_cart->treatment_result_full_absorption = $request->has('treatment_result_full_absorption');
        $radiation_treatment_cart->treatment_result_high_50_procent = $request->has('treatment_result_high_50_procent');
        $radiation_treatment_cart->treatment_result_low_50_procent = $request->has('treatment_result_low_50_procent');
        $radiation_treatment_cart->treatment_result_no_result = $request->has('treatment_result_no_result');
        $radiation_treatment_cart->treatment_result_deepening = $request->has('treatment_result_deepening');

        $ch = $radiation_treatment_cart->save();
        //18. Եզրափակիչ տվյալներ


        if ($request->filled('final_result_ctv_1')) {
            $radiation_treatment_cart->final_result_ctv_1 = $request->final_result_ctv_1;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_ctv_2')) {
            $radiation_treatment_cart->final_result_ctv_2 = $request->final_result_ctv_2;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_ctv_3')) {
            $radiation_treatment_cart->final_result_ctv_3 = $request->final_result_ctv_3;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_mod_1')) {
            $radiation_treatment_cart->final_result_mod_1 = $request->final_result_mod_1;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_mod_2')) {
            $radiation_treatment_cart->final_result_mod_2 = $request->final_result_mod_2;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_mod_3')) {
            $radiation_treatment_cart->final_result_mod_3 = $request->final_result_mod_3;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_god_1')) {
            $radiation_treatment_cart->final_result_god_1 = $request->final_result_god_1;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_god_2')) {
            $radiation_treatment_cart->final_result_god_2 = $request->final_result_god_2;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_god_3')) {
            $radiation_treatment_cart->final_result_god_3 = $request->final_result_god_3;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_jdb_1')) {
            $radiation_treatment_cart->final_result_jdb_1 = $request->final_result_jdb_1;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_jdb_2')) {
            $radiation_treatment_cart->final_result_jdb_2 = $request->final_result_jdb_2;
            $ch = $radiation_treatment_cart->save();
        }
        if ($request->filled('final_result_jdb_3')) {
            $radiation_treatment_cart->final_result_jdb_3 = $request->final_result_jdb_3;
            $ch = $radiation_treatment_cart->save();
        }

        //19․ Հատուկ նշումներ՝
        if ($request->filled('special_notes')) {
            $radiation_treatment_cart->special_notes = $request->special_notes;
            $ch = $radiation_treatment_cart->save();
        }

        if ($request->filled('anesthesiologist_id')) {
            $radiation_treatment_cart->anesthesiologist_id = $request->anesthesiologist_id;
            $ch = $radiation_treatment_cart->save();
        }

        if ($request->filled('anesthesiology_doctor_id')) {
            $radiation_treatment_cart->anesthesiology_doctor_id = $request->anesthesiology_doctor_id;
            $ch = $radiation_treatment_cart->save();
        }



        /*Test*/
        return DB::transaction(function () use ($request, $radiation_treatment_cart) {
           /* if ($request->has("has_twin")) {
                $ambulator->update([
                    "is_a_twin" => $request->has_twin,
                ]);
            }*/

            if ($request->has("patomorph_diagnosis_id") || $request->has("patomorph_diagnosis_comment")) {
                $radiation_treatment_cart->sample_diagnoses()->update([
                    'diagnosis_comment' => $request->patomorph_diagnosis_comment,
                    'disease_id' => $request->patomorph_diagnosis_id,
                    'diagnosis_type' => 'patomorph_disease',
                    'diagnosis_date' => now(),
                ]);
            }

          /*  if ($request->has("final_diagnosis") || $request->has("final_diagnosis_disease")) {
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
            }*/

            return back()->withSuccess(__("ambulator.saved"));
        });
        /*Testend*/
        $radex = $patient->radiation_treatment_cart()->findOrFail($rad_id);
        $this->authorize("belongs-to-user", $radex);

        $radex->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\RadiationTreatmentCart  $radiationTreatmentCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(RadiationTreatmentCart $em)
    {
        //
    }
}
