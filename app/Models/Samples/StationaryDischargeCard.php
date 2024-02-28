<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\SurgeryList;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryDischargeCard extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;


    protected static $logName = 'stationary_discharge_cards';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'patient_id',
        'user_id',
        "department_id",
        "stationary_id",
        'sent_patient',
        'bed_profiles',
        'accept',
        'from_injury',
        'research_date',
        'outcome_of_the_disease',
        'date_discharge_or_death',
        'research',
        'sent_diagnosis_facility',
        'hospitalized',
        'died_a_comment',
        'died_b_comment',
        'died_c_comment',
        'died_d_comment',
        'surgery_id',
        'surgery_datetime',
        'surgery_comment',
        'RW_date',
        'result',
        'armenia_war_invalid',
        'arcax_war_invalid',
        'attending_doctor_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function Doctor()
    {
        return $this->hasOne(User::class,'id','attending_doctor_id');
    }
    public function surgerylists(): HasOne
    {
        return $this->hasOne(SurgeryList::class,'id','surgery_id');
    }
}
