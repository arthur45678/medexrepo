<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PaidServiceContract extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;

    protected static $logName = 'paid_service_contracts';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ['patient_id',
        'user_id',
        'department_id',
        'director',
        'date',
        'date_start',
        'date_end',
        'doctor_refusal',
        'doctor_services',
        'doctor_intervention',
        'doctor_period_following',
        'price',
        'payment_method',
        'operates_until',
        'given',
        'fromWhom',
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
