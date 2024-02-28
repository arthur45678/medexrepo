<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\StationaryDiagnosis;
use App\Models\StationaryDisabiltyCertificate;
use App\Models\StationaryExpertiseConclusion;
use App\Models\StationaryHistologicalExamination;
use App\Models\StationarySurgery;
use App\Models\StationaryMedicineSideEffect;
use Illuminate\Http\Request;


class RadiationCartsHasManySectionsController extends Controller
{
    /**
     * Update the specified stationary_medicine_side_effects relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function medicine_side_effects(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_medicine_side_effects,id",
        ]);

        $medicine_side_effect = StationaryMedicineSideEffect::findOrFail($request->id);
        $this->authorize("belongs-to-user", $medicine_side_effect);

        $medicine_side_effect->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Update the specified stationary_diagnoses relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function diagnoses(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_diagnoses,id",
            "diagnosis_comment" => "nullable|string|max:10000",
            "diagnosis_date" => "nullable|date|before:tomorrow",
            "disease_id" => "nullable|numeric|exists:disease_lists,id",
        ]);

        $diagnosis = StationaryDiagnosis::findOrFail($request->id);
        $this->authorize("belongs-to-user", $diagnosis);

        $diagnosis->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Update the specified stationary_surgeries relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function surgeries(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_surgeries,id",
            "anesthesia_id" => "nullable|numeric|exists:anesthesia_lists,id",
            "surgery_id" => "nullable|numeric|exists:surgery_lists,id",
            "complications" => "nullable|string|max:10000",
            "surgery_date" => "nullable|date|before:tomorrow"
        ]);

        $surgery = StationarySurgery::findOrFail($request->id);
        $this->authorize("belongs-to-user", $surgery);

        $surgery->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Update the specified stationary_disability_certificates relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function disability_certificates(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_disabilty_certificates,id",
            "number" => "nullable|numeric|max:1000000",
            "from" => "nullable|date|before:tomorrow",
            "to" => "nullable|date|before:tomorrow",
        ]);

        $certificate = StationaryDisabiltyCertificate::findOrFail($request->id);
        $this->authorize("belongs-to-user", $certificate);

        $certificate->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Update the specified stationary_expertise_conclusions relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function expertise_conclusions(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_expertise_conclusions,id",
            "conclusion" => "nullable|string|max:10000",
        ]);

        $conclusion = StationaryExpertiseConclusion::findOrFail($request->id);
        $this->authorize("belongs-to-user", $conclusion);

        $conclusion->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Update the specified histological_examinations relation.
     *
     * @return \Illuminate\Http\Response
     */
    public function histological_examinations(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:stationary_histological_examinations,id",
            "examination" => "nullable|string|max:10000",
            "examination_number" => "nullable|numeric|max:1000000",
            "examination_date" => "nullable|date|before:tomorrow",
        ]);

        $examination = StationaryHistologicalExamination::findOrFail($request->id);
        $this->authorize("belongs-to-user", $examination);

        $examination->fill($request->all())->save();

        return response()->json(["success" => __("stationary.changed")]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Patient $patient
     * @param int $stationary
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient, $radiationCard)
    {

        //radiation_treatment_cart()
        $radiationCard = $patient->radiation_treatment_cart()->find($radiationCard);


        $radiationCard->loadAllRelationsForApprovement();



        return view("samples.radiation_treatment_card.relations")->with(["patient" => $patient, "radiationCard" => $radiationCard]);
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
