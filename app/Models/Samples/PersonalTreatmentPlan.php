<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PersonalTreatmentPlan extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;

    protected static $logName = 'personal_treatment_plans';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'regular',
        'patient_id',
        'department_id',
        'dateTime',
        'results',
        'laboratory_research',
        'Instrumental_research',
        'radiation_research',
        'histological_research',
        'other_research',
        'Surgical_intervention',
        'chemotherapy_treatment',
        'radiation_therapy',
        'other_interventions',
        'intermediate_control',
        'after_surgery',
        'aap_surgery',
        'to_introduce',
        'after_chemotherapy_treatment',
        'sap_chemotherapy',
        'to_come_closer',
        'after_radiation_therapy',
        'aap_radiation',
        'doctor_oncologist_radiation',
        'special_note',
        'further_control',
        'aap_control',
        'diagnostic_tests',
        'special_notes',
        'date_treatment',
        'doctor_oncologist',
        'oncologist_surgeon',
        'chemotherapist',
        'histologist',
        'radiologist',
        'specialist'
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function Oncologist()
    {
        return $this->hasOne(User::class,'id','doctor_oncologist');
    }
    public function surgeon()
    {
        return $this->hasOne(User::class,'id','oncologist_surgeon');
    }
    public function Chemotherapist()
    {
        return $this->hasOne(User::class,'id','chemotherapist');
    }
    public function Histologist()
    {
        return $this->hasOne(User::class,'id','histologist');
    }
    public function Radiologist()
    {
        return $this->hasOne(User::class,'id','radiologist');
    }
    public function Specialist()
    {
        return $this->hasOne(User::class,'id','specialist');
    }
}
