<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Extract extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;

    protected static $logName = 'extracts';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable=[
        'research',
        'patient_id',
        'user_id',
        "department_id",
        "stationary_id",
        'ambulator_id',
        'attending_doctor',
        'extract_sent',
        'for_the_first_time',
        'date',
        'tumor_histological_structure',
        'treatment_type',
        'remote_gammotherapy',
        'rentgenoterapia',
        'fast_electrons',
        'gammotherapy',
        'contact_rentgenoterapia',
        'only_chemotherapeutic_or_hormonal',
        'admission_date',
    ];
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
