<?php

namespace App\Models;

use App\Models\Samples\HealthSampleName;
use App\Models\Samples\AdviceSheet;
use App\Models\Samples\AdviceSheetInsurance;
use App\Models\Samples\AgreementHospitalRoom;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;
use App\Models\Samples\AppointmentSheetMode;

use App\Models\Samples\BixSterilizationLog;
use App\Models\Samples\CancerPatientControlCard;
use App\Models\Samples\ConsciousVoluntaryConsent;
use App\Models\Samples\DrugDestructionAct;
use App\Models\Samples\Echocardiogram;

use App\Models\Samples\ExpressPaterrn;

use App\Models\Samples\Extract;
use App\Models\Samples\HeatSheet;
use App\Models\Samples\HistologicalExamination;

use App\Models\Samples\IndividualTreatmentPlan;
use App\Models\Samples\MedicalCareAccounting1;
use App\Models\Samples\PaidServiceContract;
use App\Models\Samples\XrayExaminationLog;
use App\Models\Samples\ImmunologicalExaminationPatternN1;
use App\Models\Samples\ImmunologicalExaminationPatternN3;
use App\Models\Samples\ImmunologicalExaminationPatternN4;
use App\Models\Samples\ImmunologicalExaminationPatternN5;
use App\Models\Samples\ImmunologicalExaminationPatternN7;
use App\Models\Samples\ImmunologicalExaminationPatternN8;
use App\Models\Samples\LampOperationMode;
use App\Models\Samples\MedicalWasteRegister;
use App\Models\Samples\MicrobiologyExamination;
use App\Models\Samples\MicrobiologyExamination_Form_2;
use App\Models\Samples\PatientsManagement;
use App\Models\Samples\PersonalTreatmentPlan;
use App\Models\Samples\PlanningProtocol;
use App\Models\Samples\StationaryDischargeCard;
use App\Models\Samples\StationaryInpatientRegister;
use App\Models\Samples\SurgeryParticipants;
use App\Models\Samples\RadiationTreatmentCard;

use App\Models\Harmful;
use App\Models\Department;
use App\Models\User;
use App\Models\LivingPlaceList;
use App\Models\SocialLivingConditionList;
use App\Models\WorkingFeatureList;
use App\Models\EducationList;
use App\Models\MaritalStatusList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Contracts\Models\HasAttachments;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Model implements HasAttachments
// class Patient extends Authenticatable implements HasAttachments
{
    use LogsActivity;

    protected static $logName = 'patient';
    protected static $logAttributes = ['*'];
    // protected static $recordEvents = ['updated', 'created', 'deleted'];
    protected static $logAttributesToIgnore = ['updated_at'];

    // protected static $logOnlyDirty = true; // Log only changed values

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

    # ավելնորդ են այս հարաբերությունները, պետք եմ միայն ամբուլատոր քարտի համար
    # Api-ի համար խճճող են, քանի որ լինելու են պատմության հարաբերությունների հետ։
    // protected $with = [
    //     'first_info',
    //     'harmfuls',
    //     'cancer_groups',
    //     'ambulator'
    // ];

    protected $fillable = [
        'f_name',
        'l_name',
        'p_name',
        'archive',

        'residence_region',
        'town_village',
        'street_house',

        'workplace',
        'profession',

        'birth_date',
        'passport',
        'soc_card',
        'nationality',
        'is_male',
        // 'sex',

        'm_phone',
        'c_phone',
        'email',

        'blood_group',
        'rh_factor',

        # for Cancer patient control card START
        'residence_region_residence',
        'town_village_residence',
        'street_house_residence',
        'citizenship',

        'living_place_id',

        'social_living_condition_id',
        'working_feature_id', // 8
        'education_id', // 8
        'marital_status_id',
        # for Cancer patient control card EMD
    ];

    protected $casts = [
        // 'rh_factor' => "boolean"
    ];

    protected $appends = [
        'all_names', 'show_page_url'
    ];

    protected $with = [
        'living_place',
        'social_living_condition',
        'working_feature',
        'education',
        'marital_status',
    ];

    public function scopeAvailablePatients($query)
    {
        /**
         * ունենք երկու հինական տարբերակ - բաժինը փակ կամ բաց տիպի է՝ բաժնին կցված հիվանդները հասանելի են
         * կամ չեն տվյալ բաժնի աշխատակիցներին։ Երբ հասանելի ՉԵՆ, ապա վարիչն է տեսնում (+գրանցողը) և բաշխում
         * հիվանդներին ըստ աշխատողների՝ բժիշկների։ Երբ հասաների ԵՆ, աշխատողներից ցանկացածը կարող է տեսնել-վերցնել։
         */
        $user = auth()->user();
        if ($user->hasPermissionTo('view all-patients')) {
            return $query; // receptionists
        }

        $department = Department::find($user->department_id);
        $patients_join = $query->join('patient_connections', 'patients.id', '=', 'patient_connections.patient_id')
            ->select('patients.*', 'patient_connections.patient_id', 'patient_connections.id as connection_id');

        if ($department->closed_from_outside) {
            # 1. department_head, get patients by department_id and workers (+ own) [ids] (whereIn)
            # 1.1 Attention !!! different doctors may connect to same patient -> (distinct or groupBy)
            # 2. department_registrar, get patients by department_id
            # 3. doctor, get patients by own id only
            if ($user->hasRole('department_head')) {
                $workers_ids = User::where('department_id', '=', $user->department_id)->pluck('id');
                return $patients_join->whereIn('patient_connections.receiver_id', $workers_ids)
                    ->orWhere(
                        'patient_connections.department_id',
                        '=',
                        $user->department_id
                    )
                    // ->select('patients.*', 'patient_connections.patient_id')->groupBy('patient_id');
                    ->select('patients.*')->groupBy('patient_id');
            }

            if ($user->hasRole('department_registrar')) {
                return $patients_join->where('patient_connections.department_id', '=', $user->department_id);
            }

            if ($user->hasAnyRole(['doctor', 'head_nurse', 'nurse'])) {
                return $patients_join->where('patient_connections.receiver_id', '=', $user->id);
            }
        } else {
            # 1. department_registrar, get patients by department_id only
            # 2. department_head or doctor, get patients by own id and own department_id
            if ($user->hasRole('department_registrar')) {
                return $patients_join->where('patient_connections.department_id', '=', $user->department_id);
            }
            if ($user->hasAnyRole(['doctor', 'department_head', 'head_nurse', 'nurse'])) {
                return $patients_join
                    ->where('patient_connections.receiver_id', '=', $user->id)
                    ->orWhere('patient_connections.department_id', '=', $user->department_id);
            }
        }
    }

    public function scopeDepartmentPatients(Builder $query, Department $department): Builder
    {
        return $query->whereHas("receivers", function (Builder $q) use ($department) {
            $q->whereIn('patient_connections.receiver_id', $department->users->pluck('id'));
        })->orWhereHas("departments", function (Builder $q) use ($department) {
            $q->where("patient_connections.department_id", $department->id);
        });
    }

    public function scopeAvailablePatientsTwo(Builder $query): Builder
    {
        $user = auth()->user();
        $department = Department::with("users")->find($user->department_id);

        if ($user->hasPermissionTo('view all-patients')) {
            return $query; // receptionists
        }

        if ($user->hasRole("department_head")) {  // անհատապես օգտատերի վրա էկած պացիենտներ, բաժնի վրա էկած պացիենտներ, բաժնի որևէ օգտատերի վրա էկած պացիենտներ
            return $query->whereHas("receivers", function (Builder $q) use ($department) {
                $q->whereIn('patient_connections.receiver_id', $department->users->pluck('id'));
            })->orWhereHas("departments", function (Builder $q) {
                $q->where("patient_connections.department_id", auth()->user()->department_id);
            });
        }

        if ($department->closed_from_outside) {
            if ($user->hasRole("department_registrar")) {  // Միայն բաժնի վրա էկած պացիենտներ
                return $query->whereHas("departments", function (Builder $q) {
                    $q->where("patient_connections.department_id", auth()->user()->department_id);
                });
            }

            if ($user->hasAnyRole(["doctor", "head_nurse", "nurse"])) {  // Միայն անհատապես օգտատերի վրա էկած պացիենտներ
                return $query->whereHas("receivers", function (Builder $q) {
                    $q->where("patient_connections.receiver_id", auth()->id());
                });
            }
        } else {
            if ($user->hasRole("department_registrar")) {  // Միայն բաժնի վրա էկած պացիենտներ
                return $query->whereHas("departments", function (Builder $q) {
                    $q->where("patient_connections.department_id", auth()->user()->department_id);
                });
            }

            if ($user->hasAnyRole(["doctor", "head_nurse", "nurse"])) { // Բաժնի վրա կամ անհատապես օգտատերի վրա էկած պացիենտներ
                return $query->whereHas("receivers", function (Builder $q) {
                    $q->where('patient_connections.receiver_id', auth()->id());
                })->orWhereHas("departments", function (Builder $q) {
                    $q->where("patient_connections.department_id", auth()->user()->department_id);
                });
            }
        }

        return $query; // NO roles were matched
    }

    # Հինական տարբերությունը վերևինների նկատմամբ  այն է, որ բացի $department-ից,
    # նաև $user-նա ամեն տեղ use()-արված:
    public function scopeAvailablePatientsTwoApi(Builder $query, User $arg_user = null): Builder
    {
        $user = $arg_user; // ? $arg_user : auth()->user();
        $department = Department::with("users")->find($user->department_id);

        if ($user->hasPermissionTo('view all-patients')) {
            return $query; // receptionists
        }

        if ($user->hasRole("department_head")) {  // անհատապես օգտատերի վրա էկած պացիենտներ, բաժնի վրա էկած պացիենտներ, բաժնի որևէ օգտատերի վրա էկած պացիենտներ
            return $query->whereHas("receivers", function (Builder $q) use ($department) {
                $q->whereIn('patient_connections.receiver_id', $department->users->pluck('id'));
            })->orWhereHas("departments", function (Builder $q) use ($user) {
                $q->where("patient_connections.department_id", $user->department_id);
            });
        }

        if ($department->closed_from_outside) {
            if ($user->hasRole("department_registrar")) {  // Միայն բաժնի վրա էկած պացիենտներ
                return $query->whereHas("departments", function (Builder $q) use ($user) {
                    $q->where("patient_connections.department_id", $user->department_id);
                });
            }

            if ($user->hasAnyRole(["doctor", "head_nurse", "nurse"])) {  // Միայն անհատապես օգտատերի վրա էկած պացիենտներ
                return $query->whereHas("receivers", function (Builder $q) use ($user) {
                    $q->where("patient_connections.receiver_id", $user->id);
                });
            }
        } else {
            if ($user->hasRole("department_registrar")) {  // Միայն բաժնի վրա էկած պացիենտներ
                return $query->whereHas("departments", function (Builder $q) {
                    $q->where("patient_connections.department_id", $user->department_id);
                });
            }

            if ($user->hasAnyRole(["doctor", "head_nurse", "nurse"])) { // Բաժնի վրա կամ անհատապես օգտատերի վրա էկած պացիենտներ
                return $query->whereHas("receivers", function (Builder $q) use ($user) {
                    $q->where('patient_connections.receiver_id', $user->id);
                })->orWhereHas("departments", function (Builder $q) use ($user) {
                    $q->where("patient_connections.department_id", $user->department_id);
                });
            }
        }

        return $query; // No roles were matched
    }

    // /**
    //  * Retrieve the model for a bound value.
    //  *
    //  * @param  mixed  $value
    //  * @param  string|null  $field
    //  * @return \Illuminate\Database\Eloquent\Model|null
    //  */
    // public function resolveRouteBinding($value, $field = null)
    // {
    //     // return $this->availablePatients()->where($field ?? $this->getRouteKeyName(), $value)->first();
    //     return $this->availablePatients()->where("patients.id", $value)->first();
    // }

    // senders-receivers-departments --->>>
    public function senders(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'patient_connections', 'patient_id', 'sender_id')->withTimestamps();
    }

    public function receivers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'patient_connections', 'patient_id', 'receiver_id')->withTimestamps();
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Department', 'patient_connections', 'patient_id', 'department_id')->withTimestamps();
    }

    // <<<--- senders-receivers-departments

    public static function available_samples(): array
    {
        // $samples = config('samples.list');
        $samples = HealthSampleName::getHealthSampleNamesArray();
        return array_filter($samples, function ($sample) {
            return $sample['target'] === 'patient';
        });
    }

    public static function samples_relations(): array
    {
        return array_keys(self::available_samples());
    }

    public static function get_patient_samples($patient_with_relations): array
    {
        $relations = $patient_with_relations->getRelations();
        // dump( $relations);
        $patient_samples = [];
        foreach ($relations as $key => $relation) {
            /**
             * we need to check if relation
             * 1) is not null - for  hasOne relations, for example - ambulator.
             * 2) has count which is greater than 0 - for HasMany relations, for example stationaries.
             * 3) is into samples-list of configs
             * 4) if relation is HasOne, it's instance of App\Models\ModelName and is not collection,
             * 4-> we need to check that and set $count = 1 as integer
             * 4-> and for collections set $count by $collection->count()
             */

            if ($relation && ($relation->count() > 0) && in_array($key, self::samples_relations())) {
                $count = Str::contains(get_class($relation), 'App') ? 1 : $relation->count();
                $route_name = self::available_samples()[$key]['route_name'];
                // $index_url = self::route2Url($route_name, 'index', $patient_with_relations->id);
                $index_api_url = self::route2ApiUrl($route_name, 'index', $patient_with_relations->id);
                $patient_samples[] = array_merge(
                    self::available_samples()[$key],
                    ['count' => $count],
                    // ['index_url' => $index_url],
                    ['index_api_url' => $index_api_url]
                );
            }
        }

        return $patient_samples;
    }

    /**
     * @param string $route_name
     * @param string $action
     * @param int $patient_id
     * @return string
     */
    public static function route2ApiUrl($route_name, $action, $patient_id)
    {
        $url = self::route2Url($route_name, $action, $patient_id);
        $url_array = explode("/", $url);
        array_splice($url_array, 3, 0, array('api'));
        $api_url = implode("/", $url_array);
        return $api_url;
    }

    /**
     * @param mixed $route_name
     * @param mixed $action
     * @param mixed $patient_id
     * @return string
     */
    public static function route2Url($route_name, $action, $patient_id)
    {
        $url = route($route_name . '.' . $action, ['patient' => $patient_id]);
        return $url;
    }

    /**
     * used in javascript (sent-referrals)
     * we passign as attribute by $appends
     *
     * @return string
     */
    public function show_page_url(): string
    {
        $patient_id = $this->id;
        return $patient_id ? route('patients.show', ['patient' => $patient_id]) : route('patients.index');
    }

    public function getShowPageUrlAttribute(): string
    {
        return $this->show_page_url();
    }

    /**
     * սեռը
     *
     * @return string
     */
    public function getSexAttribute(): string
    {

        if (is_numeric($this->is_male)) {
            return $this->is_male == '1' ? "Տղամարդ" : "Կին";
        } else {
            return "--";
        }
    }

    /**
     * Անուն-ազգանուն
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->attributes["f_name"] . " " . $this->attributes["l_name"];
    }

    /**
     * ԱԱՀ
     *
     * @return string
     */
    public function getAllNamesAttribute(): string
    {
        return $this->attributes["l_name"] . " " . $this->attributes["f_name"] . " " . $this->attributes["p_name"];
    }

    public function getBirthDateReversedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->birth_date));
    }

    /**
     * Տատրքը, հաշված brith_date-ից
     * Օրերով եթե < 1 ամսից
     * Ամիսներով եթե < 1 տարուց
     * Տարիներով եթե > 1 տարուց
     *
     * @return string
     */
    public function getAgeAttribute(): string
    {
        $birthDate = Carbon::parse($this->attributes["birth_date"]);
        $now = now();
        $difference = $birthDate->age;
        $result = "{$difference} տարեկան";

        if ($difference < 1) {
            $difference = $birthDate->diffInMonths($now);
            $result = "{$difference} ամսեկան";
        }

        if ($difference < 1) {
            $difference = $birthDate->diffInDays($now);
            $result = "{$difference} oրեկան";
        }

        return $result;
    }

    /**
     * Արյան խումբը լատինատառ A, B, AB, O
     *
     * @return string
     */
    public function getBloodGroupLetterAttribute(): string
    {
        switch ($this->attributes["blood_group"]) {
            case 1:
                return "A";
            case 2:
                return "B";
            case 3:
                return "AB";
            case 4:
                return "O";
            default:
                return "---";
        }
    }

    /**
     * Ռեզուս գործոնի նշան
     *
     * @return string
     */
    public function getRhFactorSignAttribute(): string
    {
        return ($this->attributes["rh_factor"] ? "+" : "-");
    }

    /**
     * Արյան խումբը ռեզուս գործոնի հետ
     *
     * @return string
     */
    public function getBloodTypeAttribute(): string
    {
        return $this->attributes["blood_group"] . $this->getRhFactorSignAttribute();
    }

    /**
     * հիվանդի առաջնային տվյալներ, նշվում է Ամբուլատոր քարտի առաձին էջում
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function first_info(): HasMany
    {
        return $this->hasMany('App\Models\PatientFirstInfo');
    }

    public function patient_first_infos()
    {
        return $this->first_info()->with('user')->where('user_id', auth()->id())->orWhere('user_id', null);
    }

    /**
     * վնասակար սովորություններ, նշվում է Ամբուլատոր քարտի առաձին էջում
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harmfuls(): BelongsToMany
    {
        return $this->BelongsToMany('App\Models\Harmful')->withTimestamps();
    }

    # դեռ թող մնա, մարդ ես ․․․
    public function harmfuls_full_array()
    {
        $harmful_parents = Harmful::where('parent_id', null)->pluck('name', 'id')->toArray();
        $patient_harmfuls = $this->harmfuls()->get()->toArray();

        foreach ($patient_harmfuls as $key => $value) {
            if (array_key_exists($value['parent_id'], $harmful_parents)) {
                $patient_harmfuls[$key]['parent_name'] = $harmful_parents[$value['parent_id']];
            }
        }
        return $patient_harmfuls;
    }

    /**
     * Ուռուցքի, քաղցկեղի խումբ, նշվում է Ամբուլատոր քարտի առաձին էջում
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cancer_groups(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\CancerGroup')->withTimestamps()->withPivot('id as pivot_id');
    }

    /**
     * Ամբուլատոր քարտ, կարող է լինել միայն մի հատ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ambulator(): HasOne
    {
        return $this->HasOne('App\Models\Ambulator');
    }

    /**
     * Ստացիոնար քարտ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stationaries(): HasMany
    {
        return $this->hasMany('App\Models\Stationary');
    }

    /**
     * Էնդոսկոպիկ ուլտրաձայնային հետազոտություններ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ultrasound_endoscopic_examinations(): HasMany
    {
        return $this->hasMany('App\Models\Samples\UltrasoundEndoscopicExamination');
    }

    /**
     * Էրիտրոցիտների մորֆոլոգիա
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function erythrocyte_morphologies(): HasMany
    {
        return $this->hasMany("App\Models\Samples\ErythrocyteMorphology");
    }

    public function radiation_treatment_card(): HasMany
    {
        return $this->hasMany(RadiationTreatmentCard::class);
    }


    public function assignment_sheet(): HasMany
    {
        return $this->hasMany(AppointmentSheetMode::class);
    }


    public function bix_sterilisation_log(): HasMany
    {
        return $this->hasMany(BixSterilizationLog::class);
    }

    public function histological_examinations(): HasMany
    {
        return $this->hasMany(HistologicalExamination::class);
    }

    /**
     * Բժշկական թափոններ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function medical_waste_register(): HasMany
    {
        return $this->hasMany(MedicalWasteRegister::class);
    }

    /**
     * Թմրամիջոցների ոչնչացման ակտ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function drug_destruction_act(): HasMany
    {
        return $this->hasMany(DrugDestructionAct::class);
    }

    /**
     * Վիրահատության մասնակիցներ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function surgery_participants(): HasMany
    {
        return $this->hasMany(SurgeryParticipants::class);
    }

    /**
     * ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function microbiology_examination(): HasMany
    {
        return $this->hasMany(MicrobiologyExamination::class);
    }
    /**
     * Մանրեաբանական լաբորատորիա: Բժշկական ձև 2
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function microbiology_examination_form_2(): HasMany
    {
        return $this->hasMany(MicrobiologyExamination_Form_2::class);
    }
    /**
     * Մանրեաբանական լաբորատորիա: Բժշկական ձև 2
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advice_sheet(): HasMany
    {
        return $this->hasMany(AdviceSheet::class);
    }

    /**
     * Մանրեաբանական լաբորատորիա: Բժշկական ձև 2
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advice_sheet_insurance(): HasMany
    {
        return $this->hasMany(AdviceSheetInsurance::class);
    }


    /**
     * Արյան փոխներարկման մատյան
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function blood_transfusion_record_books(): HasOne
    {
        return $this->hasOne("App\Models\Samples\BloodTransfusionRecordBook");
    }

    public function hospitalization_referrales(): HasOne
    {
        return $this->hasOne("App\Models\Samples\HospitalizationReferral");
    }

    public function references(): HasOne
    {
        return $this->hasOne("App\Models\Samples\Reference");
    }

    public function microscopies(): HasOne
    {
        return $this->hasOne("App\Models\Samples\Microscopy");
    }

    public function referrals(): HasMany
    {
        return $this->hasMany('App\Models\Referral');
    }

    public function conscious_voluntary_consents(): HasMany
    {
        return $this->hasMany(ConsciousVoluntaryConsent::class);
    }

    public function echo_cardiograms(): HasMany
    {
        return $this->hasMany(Echocardiogram::class);
    }
    public function heat_sheet(): HasMany
    {
        return $this->hasMany(HeatSheet::class);
    }

    public function patients_managements(): HasMany
    {
        return $this->hasMany(PatientsManagement::class);
    }

    /*public function conscious_voluntary_consent(): HasMany
    {
        return $this->hasMany(ConsciousVoluntaryConsent::class);
    }*/

    public function awareness_sheets(): HasOne
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

    public function biochemical_labs_n1(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN1");
    }

    public function biochemical_labs_n2(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN2");
    }

    public function biochemical_labs_n3(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN3");
    }

    public function biochemical_labs_n4(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN4");
    }

    public function biochemical_labs_n5(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN5");
    }

    public function biochemical_labs_n7(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN7");
    }

    public function patients_epicrise(): HasMany
    {
        return $this->hasMany(ExpressPaterrn::class);
    }

    public function patients_exprres(): HasMany
    {
        return $this->hasMany(ExpressPaterrn::class);
    }

    public function personalTreatmentPlan(): HasMany
    {
        return $this->hasMany(PersonalTreatmentPlan::class);
    }

    public function biochemical_labs_n8(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN8");
    }

    public function biochemical_labs_n9(): HasMany
    {
        return $this->hasMany("App\Models\Samples\BiochemicalLabN9");
    }

    public function clinical_labs_n2(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN2");
    }

    public function ImmunologicalExaminationPatternN1(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN1::class);
    }

    public function ImmunologicalExaminationPatternN3(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN3::class);
    }

    public function ImmunologicalExaminationPatternN4(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN4::class);
    }

    public function ImmunologicalExaminationPatternN5(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN5::class);
    }
    public function ImmunologicalExaminationPatternN7(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN7::class);
    }
    public function ImmunologicalExaminationPatternN8(): HasMany
    {
        return $this->hasMany(ImmunologicalExaminationPatternN8::class);
    }

    public function clinical_labs_n11(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN11");
    }

    public function clinical_labs_n12(): HasOne
    {
        return $this->hasOne("App\Models\Samples\ClinicalLabN12");
    }

    public function LampOperationMode(): HasMany
    {
        return $this->hasMany(LampOperationMode::class);
    }

    public function PlanningProtocols(): HasMany
    {
        return $this->hasMany(PlanningProtocol::class);
    }
    public function StationaryInpatientRegisters(): HasMany
    {
        return $this->hasMany(StationaryInpatientRegister::class);
    }

    public function inventory_accountings(): HasOne
    {
        return $this->hasOne("App\Models\Samples\InventoryAccounting");
    }
    public function AnesthesiologistPreSurgeryExamination(): HasMany
    {
        return $this->hasMany(AnesthesiologistPreSurgeryExamination::class);
    }
    public function StationaryDischargeCard(): HasMany
    {
        return $this->hasMany(StationaryDischargeCard::class);
    }

    public function xray_examination_logs(): HasOne
    {
        //return $this->hasOne(XrayExaminationLog::class);
        return $this->hasOne(XrayExaminationLog::class);
    }

    public function sterilization_mode_sisters(): HasOne
    {
        return $this->hasOne("App\Models\Samples\SterilizationModeSister");
    }
    public function AgreementHospitalRoom(): HasOne
    {
        return $this->hasOne(AgreementHospitalRoom::class);
    }
    public function paidServiceContract(): HasMany
    {
        return $this->hasMany(PaidServiceContract::class);
    }
    public function MedicalCareAccounting(): HasMany
    {
        return $this->hasMany(MedicalCareAccounting1::class);
    }
    public function CancerPatientControlCard(): HasMany
    {
        return $this->hasMany(CancerPatientControlCard::class);
    }
    public function IndividualTreatmentPlan(): HasMany
    {
        return $this->hasMany(IndividualTreatmentPlan::class);
    }
    public function Extract(): HasMany
    {
        return $this->hasMany(Extract::class);
    }


    # additional data for control cald
    public function living_place(): BelongsTo
    {
        return $this->belongsTo(LivingPlaceList::class);
    }

    public function social_living_condition(): BelongsTo
    {
        return $this->belongsTo(SocialLivingConditionList::class);
    }

    public function working_feature(): BelongsTo
    {
        return $this->belongsTo(WorkingFeatureList::class);
    }

    public function education(): BelongsTo
    {
        return $this->belongsTo(EducationList::class);
    }

    public function marital_status(): BelongsTo
    {
        return $this->belongsTo(MaritalStatusList::class);
    }
}
