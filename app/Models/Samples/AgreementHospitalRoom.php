<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AgreementHospitalRoom extends  Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'agreement_hospital_rooms';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'date',
        'company_name',
        'recommended',
        'patient_id',
        'user_id',
        'department_id',
        'director',
    ];
public function user()
{
    return $this->hasOne(User::class,'id','user_id');
}
    public function Director_Name()
    {
        return $this->hasOne(User::class, 'id', 'director');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
