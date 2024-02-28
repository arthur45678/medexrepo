<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class ImmunologicalExaminationPatternN1 extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;

    protected static $logName = 'immunological_n1_s';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'research',
        'patient_id',
        'ambulator_id',
        'user_id',
        "department_id",
        'specialist',
        'attending_doctor',
        'hospital_room_number',
        "stationary_id",
        'date',
        'CRP',
        'ASO',
        'RF',
        'date_research',
    ];
    public function doctor()
    {
        return $this->hasOne(User::class,'id','specialist');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function attendingdoctor()
    {
        return $this->hasOne(User::class, 'id', 'attending_doctor');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
