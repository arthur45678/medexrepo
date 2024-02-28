<?php

namespace App\Models;

use App\Enums\StationaryAgeTypeEnum;
use App\Enums\StationaryWorkEfficiencyEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;

class Stationary extends Model
{
    use LogsActivity, HasEnums;

    protected $with = [ // RELATION NAME - NESTED RELATION
        "clinic",

        "stationary_diagnoses",  // 7 տեսակի ախտոորշումներ/հիվանդություններ - հիվանդությունների ցանկ, բժշկի անուն
        "stationary_diagnoses.disease_item",

        "department",

        "stationary_medicine_side_effects", //Դեղանյութեր ալերգիա ԿԱՄ անտենելիություն - դեղերի ցանկ, բժշկի անուն (դեռ չի օգտագործվում)
        "stationary_medicine_side_effects.medicine_item",

        "stationary_treatments",
        "stationary_treatments.treatment_item",


        "stationary_surgeries", // Վիրահատություններ - վիահատությունների ցանկ, անզագացումների ցանկ, բժիշկի անուն
        "stationary_surgeries.anesthesia",
        "stationary_surgeries.surgery",
        "stationary_surgeries.user",

        "stationary_disability_certificates", // Անաշխատունակության թերթիկ - բժշկի(կամ այլ օգտատերի) անուն (դեռ չի օգտագործվում)
        "stationary_disease_outcomes", // Հիվանդության ելք - transferred_clinic տեղափոխված հաստատություն, բժշկի անուն (դեռ չի օգտագործվում)
        "stationary_expertise_conclusions", // Փորձաքննության արդյունք - բժշկի անուն (դեռ չի օգտագործվում)
        "stationary_histological_examinations", // Հյուսածքաբանական հետազոտություն - բժշկի անուն (դեռ չի օգտագործվում)

        "stationary_harmfuls", // Վնասակար սովորություններ
        "tumor_treatments",
        "attending_doctor", // Բուժող բժիշկ
        "department_head", // Բաժանմունքի վարիչ

        "stationary_primary_examination", // Առաջնային զննում
        "stationary_present_status", // Status Praensus Subjectivus et Objectivus - 4րդ էջ
        "stationary_for_analysis", // 9-րդ էջ
        "stationary_surgery_justifications", // 10 4րդ էջ

        "stationary_surgery_descriptions",
        // "stationary_surgery_descriptions.user",
        "stationary_surgery_descriptions.surgeon",
        "stationary_surgery_descriptions.assistant",
        "stationary_surgery_descriptions.surgical_sister",

        "stationary_disease_courses", //  հիվանդության ընթացքը - stationary 15-16
        "stationary_prescriptions", //  հիվանդության ընթացքի ստացիոնարի նշանակումներ - stationary 15-16
        "stationary_prescriptions.medicine_item", // 15-16 դեղի անուն, կոդ ․․․

        "stationary_pathological_anatomical", // 18-page
        "stationary_special_note", // 19-page
        "stationary_treatment_evaluation" // 20-page

    ];

    protected $enums = [
        "age_type" => StationaryAgeTypeEnum::class . ":nullable",
        "work_efficiency_status" => StationaryWorkEfficiencyEnum::class . ":nullable",
    ];

    protected static $logName = 'stationary';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "number",
        "patient_id",
        "age",
        "age_type",

        "height",
        "weight",
        "by_wheelchair",

        "admission_date",
        "discharge_date",
        "stage",
        // "tnm",

        "T",
        "N",
        "M",

        "Grade",
        "L",
        "V",
        "pycmr",

        "chamber",
        "is_paid",
        "bed",
        "department_id",
        "days_qty",

        "clinic_id",

        "is_urgent",
        "hours_later",
        "is_planned",
        "from_disease_start",

        "malaria_endemic_zone",
        "times_hospitalized",

        "work_efficiency_status",
        "work_efficiency_comment",

        "attending_doctor_id",
        "department_head_id"
    ];

    protected $casts = [
        "by_wheelchair" => "integer",
        "is_paid" => "boolean",
        "is_urgent" => "integer",
        "is_planned" => "integer",
        "from_disease_start" => "integer",
        "malaria_endemic_zone" => "integer",
        "work_efficiency_status" => "string",
    ];

    protected $approvableSections = [
        "stationary_diagnoses",
        "stationary_medicine_side_effects",
        "stationary_surgeries",
        "stationary_treatments",
        "stationary_disability_certificates",
        "stationary_expertise_conclusions",
        "stationary_histological_examinations",
        "stationary_primary_examination",
        "stationary_present_status",
        "stationary_ultrasound_endoscopies",
        "stationary_xray_examinations",
        "stationary_cellular_examinations",
        "stationary_expert_advice",
        "stationary_for_analysis",
        "stationary_surgery_justifications",
        "stationary_surgery_protocols",
        "stationary_surgery_descriptions",
        "stationary_disease_courses",
        "stationary_resuscitation_departments",
        "stationary_epicrisis",
        "stationary_pathological_anatomical",
        "stationary_special_note",
        "stationary_treatment_evaluation"
    ];

    public function getApprovableSections(): array
    {
        return $this->approvableSections;
    }

    public function loadAllRelationsForApprovement(): void
    {
        $allSectionsWithNestedRelations = $this->getApprovableSections();

        // foreach($allSectionsWithNestedRelations as $i => $relation){
        //     $relation
        // }

        foreach ($this->getApprovableSections() as $relatedSection) {
            $allSectionsWithNestedRelations[] = $relatedSection . ".user";
            $allSectionsWithNestedRelations[] = $relatedSection . ".approvement";
        }

        $this->loadMissing($allSectionsWithNestedRelations);
    }

    public function getBmiAttribute(): float
    {
        $obesity = 0;
        $weight = $this->attributes['weight'];
        $height = $this->attributes['height'];
        $height_meter = $height / 100;
        if (($weight && $height) && ($weight > 0 && $height > 0)) {
            $obesity = $weight / pow($height_meter, 2);
        }
        return round($obesity, 1);
    }

    public function getNutritionalStatusAttribute(): string
    {
        $bmi = $this->getBmiAttribute();
        $status = '';
        if ($bmi == 0) {
            $status = 'քաշը կամ/և հասակը լրացված չեն';
        } elseif ($bmi > 0 && $bmi < 18.5) {
            $status = 'թերի քաշ';
        } elseif ($bmi > 18.5 && $bmi < 24.9) {
            $status = 'նորմալ քաշ';
        } elseif ($bmi > 25 && $bmi < 29.9) {
            $status = 'ավելցուկային քաշ';
        } elseif ($bmi > 30 && $bmi < 34.9) {
            $status = 'I աստիճանի ճարպակալում';
        } elseif ($bmi > 35 && $bmi < 39.9) {
            $status = 'II աստիճանի ճարպակալում';
        } else {
            // $bmi > 40
            $status = 'III աստիճանի ճարպակալում';
        }
        return $status;
    }


    public function mzi(){
        $m = $this->weight;
        $h = $this->height;
        $hh = $h / 100;
        $z = $hh * $hh;
        $mzi = $m / $z;
        $format = number_format($mzi,2);
        return $format;
    }

    public function stationary_diagnoses(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiagnosis");
    }

    public function stationary_primary_diagnosis()
    {
        return $this->stationary_diagnoses()->where('diagnosis_type', 'primary_disease')->with('disease_item', 'user')->first();
    }

    public function stationary_treatments(): HasMany
    {
        return $this->hasMany("App\Models\StationaryTreatment");
    }

    public function stationary_disability_certificates(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDisabiltyCertificate");
    }

    public function stationary_surgeries(): HasMany
    {
        return $this->hasMany("App\Models\StationarySurgery");
    }

    public function stationary_disease_outcomes(): HasOne
    {
        return $this->HasOne("App\Models\StationaryDiseaseOutcome");
    }

    public function stationary_expertise_conclusions(): HasMany
    {
        return $this->hasMany("App\Models\StationaryExpertiseConclusion");
    }

    public function stationary_histological_examinations(): HasMany
    {
        return $this->hasMany("App\Models\StationaryHistologicalExamination");
    }

    public function stationary_medicine_side_effects(): HasMany
    {
        return $this->hasMany("App\Models\StationaryMedicineSideEffect");
    }

    public function stationary_primary_examination(): HasOne
    {
        return $this->hasOne("App\Models\StationaryPrimaryExamination");
    }

    public function stationary_harmfuls(): HasMany
    {
        return $this->hasMany("App\Models\StationaryHarmful");
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Patient");
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo("App\Models\Clinic");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\Models\Department");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "attending_doctor_id", "id");
    }

    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "department_head_id", "id");
    }

    public function tumor_treatments(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\TumorTreatmentList", "stationary_tumor_treatment");
    }

    public function stationary_present_status(): HasOne
    {
        return $this->hasOne('App\Models\StationaryPresentStatus');
    }

    public function stationary_ultrasound_endoscopies(): HasMany
    {
        return $this->hasMany("App\Models\StationaryUltrasoundEndoscopy");
    }

    public function stationary_xray_examinations(): HasMany
    {
        return $this->hasMany("App\Models\StationaryXrayExamination");
    }

    public function stationary_cellular_examinations(): HasMany
    {
        return $this->hasMany("App\Models\StationaryCellularExamination");
    }

    public function stationary_expert_advice(): HasMany
    {
        return $this->hasMany("App\Models\StationaryExpertAdvice");
    }

    public function stationary_for_analysis(): HasMany
    {
        return $this->hasMany("App\Models\StationaryForAnalysis");
    }

    public function stationary_surgery_justifications(): HasMany
    {
        return $this->hasMany("App\Models\StationarySurgeryJustification");
    }

    public function stationary_surgery_protocols(): HasMany
    {
        return $this->hasMany("App\Models\StationarySurgeryProtocol");
    }

    public function stationary_surgery_descriptions(): HasMany
    {
        return $this->hasMany("App\Models\StationarySurgeryDescription");
    }

    public function stationary_disease_courses(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiseaseCourse");
    }

    public function stationary_prescriptions(): HasMany
    {
        return $this->hasMany("App\Models\StationaryPrescription");
    }

    public function stationary_resuscitation_departments(): HasMany
    {
        return $this->hasMany("App\Models\StationaryResuscitationDepartment");
    }

    public function stationary_epicrisis(): HasOne
    {
        return $this->hasOne("App\Models\StationaryEpicrisis");
    }

    public function stationary_pathological_anatomical(): HasOne
    {
        return $this->hasOne("App\Models\StationaryPathologicalAnatomical");
    }

    public function stationary_special_note(): HasMany
    {
        return $this->hasMany("App\Models\StationarySpecialNote");
    }

    public function stationary_treatment_evaluation(): HasOne
    {
        return $this->hasOne("App\Models\StationaryTreatmentEvaluation");
    }

    public function stationary_social_packages(): HasMany
    {
        return $this->hasMany("App\Models\StationarySocialPackage");
    }


}
