<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PlanningProtocol extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;


    protected static $logName = 'immunological_n1_s';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'parent_date',
        'date_treatment',
        'patient_id',
        'user_id',
        'specialist',
        'medical_device',
        'device',
        'portal_imaging',
        'portal',
        'MRI_fusion',
        'fusion',
        'course_info',
        'course',
        'section_info',
        'section',
        'MOD_info',
        'GOD_info',
        'boost_info',
        'boost',
        'risk_organs',
        'special_notes',
        'performing_physicist',
        'healer_doctor',
        'date',
        'section_step',
        'patient_position',
        'position',
        'contrast_info',
        'contrast',
        'breast',
        'n1_height',
        'n1_headache',
        'n1_hands',
        'n1_hand',
        'corner',
        'n2_hand',
        'n2_headache_info',
        'arched_position',
        'n2_height',
        'n2_special_notes',
        'n2_headache',
        'belly_board',
        'board',
        'board_info',
        'mask',
        'mask_info',
        'notes',
        'notes_info',
        'scar_notes',
        'scar_notes_info',
        'breast_notes',
        'breast_notes_info',
        'performer',
        'n2_healer_doctor',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function healerdoctor()
    {
        return $this->hasOne(User::class,'id','healer_doctor');
    }
    public function healer_doctorN2()
    {
        return $this->hasOne(User::class,'id','n2_healer_doctor');
    }
    public function Performing_physicist()
    {
        return $this->hasOne(User::class,'id','performing_physicist');
    }
    public function Performer()
    {
        return $this->hasOne(User::class,'id','performer');
    }

}
