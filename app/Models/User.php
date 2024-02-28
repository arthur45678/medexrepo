<?php

namespace App\Models;

use App\Models\Samples\AdviceSheet;
use App\Models\Samples\HistologicalExamination;
use App\Models\Samples\RadiationTreatmentCard;
use App\Models\Samples\SampleDiagnose;
use App\Models\Samples\SamplesMedicinelist;
use App\Models\Samples\SampleSurgeries;
use App\Models\Samples\SampleTreatments;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\HasCacheableOptions;
use Spatie\Permission\Traits\HasRoles;
use DB;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Contracts\Models\HasAttachments;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements HasAttachments
{
    use Notifiable, CausesActivity, HasCacheableOptions, HasRoles;

    protected $fillable = [
        'f_name',
        'l_name',
        'p_name',
        'username',
        'password',
        'department_id',
        'department_code',
        'account_suspended',

        'residence_region',
        'town_village',
        'street_house',

        'degree',
        'position',
        'background',
        'birth_date',
        'passport',
        'soc_card',
        'nationality',
        'is_male',
        // 'sex',
        'm_phone',
        'c_phone',
        'email',

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];


    /**
     * Get the 2 columns to select as LABEL and VALUE for HTML <select>
     *
     * @return array
     */
    protected static function getColumnsForOptions(): array
    {
        return ["id as value", DB::raw("CONCAT(f_name, ' ', l_name) as label")];
    }

    public function getFullNameAttribute(): string
    {
        return $this->f_name . " " . $this->l_name;
    }

    public function getInitialsAttribute(): string
    {
        $f_name = $this->f_name;
        $l_name = $this->l_name;

        $f = $this->f_name ? mb_substr($f_name,0, 1) : 'X';
        $l = $this->l_name ? mb_substr($l_name,0, 1) : 'X';
        return $f.".".$l.".";
    }

    /**
     *  Returns all/specified the hasMany components from stationary - groupped by their types
     *
     *  @param array $desiredRelations
     *  @param int $stationary_id
     *  @return App\Models\User
     */
    public function getStationaryRelations(array $desiredRelations, int $stationary_id): User
    {
        $relations = [];

        foreach ($desiredRelations as $relation) {
            $relations[$relation] = function (HasMany $q) use ($stationary_id) {
                $q->where("stationary_id", $stationary_id);
            };
        }


        $user = $this->with($relations)->find($this->id);

        if ($user->stationary_medicine_side_effects)
            $user->stationary_medicine_side_effects_groupped = $user->stationary_medicine_side_effects->groupBy("type_value");

        if ($user->stationary_diagnoses)
            $user->stationary_diagnoses_groupped = $user->stationary_diagnoses->groupBy("diagnosis_type_value");

        if ($user->stationary_surgeries)
            $user->stationary_surgeries_groupped = $user->stationary_surgeries->groupBy("type_value");
        return $user;
    }


    public function getSamplesRelations(array $desiredRelations, int $sample_id): User
    {

        $user = $this->find($this->id);

        if ($user->sample_diagnoses)
            $user->sample_diagnoses_groupped = $user->sample_diagnoses->groupBy("diagnosis_type_value");

        if ($user->sample_medicinelists)
            $user->sample_medicinelists_groupped = $user->sample_medicinelists->groupBy("medicinelists_type_value");
        if ($user->sample_surgeries)
            $user->sample_surgeries_groupped = $user->sample_surgeries->groupBy("surgeries_type_value");

        if ($user->sample_treatments)
            $user->sample_treatments_groupped = $user->sample_treatments->groupBy("type_value");

        return $user;
    }

    // roles
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Relation to the diagnoses written by this user (Ամբուլատոր քարտ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagnoses(): HasMany
    {
        return $this->hasMany('App\Models\Diagnosis');
    }

    /**
     * Relation to the attendances written by this user (Ամբուլատոր քարտ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * Relation to the complaints written by this user (Ամբուլատոր քարտ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints(): HasMany
    {
        return $this->hasMany('App\Models\Complaint');
    }

    /**
     * Relation to the female_issues written by this user (Ամբուլատոր քարտ, 2-րդ էջ աջ մաս)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function female_issues(): HasMany
    {
        return $this->hasMany('App\Models\FemaleIssue');
    }

    /**
     * Relation to the onset_and_developments written by this user (Ամբուլատոր քարտ, աճ և զարգացում)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onset_and_developments(): HasMany
    {
        return $this->hasMany('App\Models\OnsetAndDevelopment');
    }

    /**
     * Relation to the tumor_infos written by this user (Ամբուլատոր քարտ, Ուռուցքի նկարագրութուն)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tumor_infos(): HasMany
    {
        return $this->hasMany('App\Models\TumorInfo');
    }

    /**
     * Relation to the health_statuses written by this user (Ամբուլատոր քարտ, 3-րդ էջ, հիվանդի վիճակ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function health_statuses(): HasMany
    {
        return $this->hasMany('App\Models\HealthStatus');
    }

    /**
     * Relation to the stationary cards attended by this user (Ստացիոնար քարտ, Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attending_stationaries(): HasMany
    {
        return $this->hasMany('App\Models\Stationary', "attending_doctor_id", "id");
    }

    /**
     * Relation to the stationary cards where this user is selected as department head (Ստացիոնար քարտ, Բաժնի վարիչ)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function department_stationaries(): HasMany
    {
        return $this->hasMany('App\Models\Stationary', "department_head_id", "id");
    }

    /**
     * Relation to the stationary_diagnoses written by this user (Ստացիոնար քարտ, Բոլոր ICD + A - ները)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stationary_diagnoses(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiagnosis");
    }

    /**
     * Relation to the sample_diagnoses written by this user (Ձևանմուշներ, Բոլոր ICD + A - ները)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sample_diagnoses(): HasMany
    {
        return $this->hasMany(SampleDiagnose::class);
    }
    /**
     * Relation to the sample_medicinelists written by this user (Ձևանմուշներ, Բոլոր ICD + A - ները)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sample_medicinelists(): HasMany
    {
        return $this->hasMany(SamplesMedicinelist::class);
    }

    /**
     * Relation to the sample_medicinelists written by this user (Ձևանմուշներ, Բոլոր ICD + A - ները)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sample_surgeries(): HasMany
    {
        return $this->hasMany(SampleSurgeries::class);
    }

    /**
     * Relation to the sample_medicinelists written by this user (Ձևանմուշներ, Բոլոր ICD + A - ները)
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sample_treatments(): HasMany
    {
        return $this->hasMany(SampleTreatments::class);
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

    public function stationary_disease_outcomes(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiseaseOutcome");
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

    public function stationary_harmfuls(): HasMany
    {
        return $this->hasMany("App\Models\StationaryHarmful");
    }

    public function stationary_ultrasound_endoscopies(): HasMany
    {
        return $this->hasMany("App\Models\StationaryUltrasoundEndoscopy");
    }

    public function stationary_xray_examinations(): HasMany
    {
        return $this->hasMany("App\Models\StationaryXrayExamination");
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

    public function stationary_cellular_examinations(): HasMany
    {
        return $this->hasMany("App\Models\StationaryCellularExamination");
    }

    public function stationary_disease_courses(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiseaseCourse");
    }

    public function stationary_resuscitation_departments(): HasMany
    {
        return $this->hasMany("App\Models\StationaryResuscitationDepartment");
    }

    public function stationary_special_notes(): HasMany
    {
        return $this->hasMany("App\Models\StationarySpecialNote");
    }

    public function  ultrasoud_endoscopic_examinations(): HasMany
    {
        return $this->hasMany('App\Models\UltrasoundEndoscopicExamination');
    }


    public function histological_clinical_diagnosis(): HasMany
    {
        return $this->hasMany(HistologicalExamination::class);
    }

    public function histological_summary_diagnosis(): HasMany
    {
        return $this->hasMany(HistologicalExamination::class);
    }
    public function advice_sheet_diagnosis(): HasMany
    {
        return $this->hasMany(AdviceSheet::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo('App\Models\Department');
    }

    // patient_connections
    public function sent_patients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Patient', 'patient_connections', 'sender_id', 'patient_id')->withTimestamps();
    }

    public function received_patients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Patient', 'patient_connections', 'receiver_id', 'patient_id')->withTimestamps();
    }

    // User update
    public static function updateUser($data, $id)
    {

        !empty($data['account_suspended']) ? $data['account_suspended'] = 1 : $data['account_suspended'] = 0;
        $user = self::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function erythrocyte_morphologies(): HasMany
    {
        return $this->hasMany("App\Models\Samples\ErythrocyteMorphology");
    }

    public function  microscopies(): HasOne
    {
        return $this->hasOne("App\Models\Samples\Microscopy");
    }

    public function hospitalization_referrales(): HasOne
    {
        return $this->hasOne("App\Models\Samples\HospitalizationReferral");
    }

    //referrals

    /**
     * Relation to the referrals received by this user. referrals.receiver_id = users.id
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function received_referrals(): HasMany
    {
        return $this->hasMany("App\Models\Referral", "receiver_id", "id");
    }

    /**
     * Relation to the referrals sent by this user. referrals.sender_id = users.id
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sent_referrals(): HasMany
    {
        return $this->hasMany("App\Models\Referral", "sender_id", "id");
    }

    //endreferrals

    public function references(): HasOne
    {
        return $this->hasOne("App\Models\Samples\Reference");
    }

    public function nonMedicalReferrals()
    {
        return $this->hasOne(NonMedicalReferral::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function queues() : HasMany {
        return $this->hasMany('App\Models\Queue');
    }

    public function director(): HasOne
    {
        return $this->hasOne("App\Models\Samples\AwarenessSheet");
    }

    public function department_head(): HasOne
    {
        return $this->hasOne("App\Models\Samples\AwarenessSheet");
    }

    public function anesthesiology_presurgery_examinations(): HasOne
    {
        return $this->hasOne("App\Models\Samples\AnesthesiologistPreSurgeryExamination");
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany("App\Models\Attachable", "attachable");
    }

    public function biochemical_labs_n1(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN1");
    }

    public function biochemical_labs_n2(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN2");
    }

    public function biochemical_labs_n3(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN3");
    }

    public function biochemical_labs_n4(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN4");
    }

    public function biochemical_labs_n5(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN5");
    }

    public function biochemical_labs_n7(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN7");
    }

    public function biochemical_labs_n8(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN8");
    }

    public function biochemical_labs_n9(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BiochemicalLabN9");
    }

    public function clinical_labs_n2(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN2");
    }

    public function clinical_labs_n11(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN11");
    }

    public function clinical_labs_n12(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN12");
    }

    public function inventory_accountings(): HasOne
    {
        return $this->hasOne("App\Models\Samples\InventoryAccounting");
    }

    public function xray_examination_logs(): HasOne
    {
        return $this->hasOne("App\Models\Samples\XrayExaminationLog");
    }

    public function sterilization_mode_sisters(): HasOne
    {
        return $this->hasOne("App\Models\Samples\SterilizationModeSister");
    }

    public function department_connections() : HasMany
    {
        return $this->hasMany("App\Models\DepartmentConnection");
    }

    public function accounting_for_researchs(): HasOne
    {
        return $this->hasOne("App\Models\OtherSamples\AccountingForResearch");
    }

    /**
     * Scope a query to only include users of a given department_id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $department_id
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeDepartmentStaff($query, $department_id): Builder
    {
        $department_connections = DepartmentConnection::where('user_id', '=', auth()->id())->pluck('department_id');
        if(!$department_connections->contains($department_id)) {
            abort(403, __('authorization.user.can-not-view-department-staff'));
        }
        return $query->where('department_id', '=', $department_id);
    }

    public function stationary_social_packages(): HasMany
    {
        return $this->hasMany("App\Models\StationarySocialPackage");
    }

    public function user_work_time_bulletins(): HasMany
    {
        return $this->hasMany("App\Models\OtherSamples\UserWorkTimeBulletin");
    }

}
