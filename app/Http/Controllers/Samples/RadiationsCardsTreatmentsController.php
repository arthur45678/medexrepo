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
use App\Models\Samples\RadiationTreatmentFinalData;
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



class RadiationsCardsTreatmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $apse_list = RadiationTreatmentCard::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.radiation_treatment_cards.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view("samples.radiation_treatment_cards.create", compact(
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
            "stationaries"
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

        $request->validate([
            'surgery_date' => 'nullable|date|before:tomorrow',
            'radiation_treatment_date' => 'nullable|date|before:tomorrow',
         //   'supplement_doctor_id' => 'required|numeric|exists:users,id',
        ]);


        $radiationTreatment = new RadiationTreatmentCard();
        $radiationTreatment->storeData($request,$patient->id);

        return redirect()->route("samples.patients.radiation-treatment-card.index", ['patient' => $patient])
            ->with(['success' => __('samples.created')]);

       // return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $card = $patient->radiation_treatment_card()->findOrFail($id);
        return view("samples.radiation_treatment_cards.show",compact('card','patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {

        $card = $patient->radiation_treatment_card()->findOrFail($post_id);
        $this->authorize("belongs-to-user", $card);

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

        return view("samples.radiation_treatment_cards.edit")->with(compact(
            'patient',
            'card',
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
            "stationaries"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'patient_age' => 'nullable|date|before:tomorrow',
       //     'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $post = $patient->radiation_treatment_card()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }


    public function storeRadiationTreatmentPlan(Request $request, $card_id)
    {

        $treatmentPlan = new RadiationTreatmentPlan();
        $treatmentPlan->storeData($request, $card_id);
        //return response()->json(['success' => __('samples.created')]);
        return redirect()->back()->with([['success' => __('samples.created')]]);

    }

    public function updateRadiationTreatmentPlan(Request $request, $plan_id)
    {
        $treatmentPlan = RadiationTreatmentPlan::find($plan_id);
        $treatmentPlan->updateData($request);
        return response()->json(['success' => __('samples.updated')]);
    }


    public function storeRadiationTreatmentNotes(Request $request, $card_id)
    {

        //radiation_date
        $treatmentPlan = new RadiationTreatmentNotes();
        $treatmentPlan->storeData($request, $card_id);

       // return response()->json(['success' => __('samples.created')]);
        return redirect()->back()->with([['success' => __('samples.created')]]);

    }

    public function updateEadiationTreatmentNotes(Request $request, $note_id)
    {
        $treatmentNotes = RadiationTreatmentNotes::find($note_id);
        $treatmentNotes->updateData($request);
        return response()->json(['success' => __('samples.updated')]);
    }

    public function storeRadiationFinalData(Request $request, $card_id)
    {
        $item = new RadiationTreatmentFinalData();
        $item->storeData($request, $card_id);

       // return response()->json(['success' => __('samples.created')]);
        return redirect()->back()->with([['success' => __('samples.created')]]);
    }

    public function updateRadiationFinalData(Request $request, $data_id)
    {
        $treatmentFinalData = RadiationTreatmentFinalData::find($data_id);
        $treatmentFinalData->updateData($request);
        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = RadiationTreatmentCard::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
