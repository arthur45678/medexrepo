<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ImmunologicalExaminationPatternN3 extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;


    protected static $logName = 'immunological_n3_s';

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
        'HAV',
        'HBsAg',
        'aոti_HBcAg_b',
        'aոti_HBcAg_Ig',
        'aոti_HBcAg_Hepatitis_b',
        'HCV_Hepatitis_C',
        'MIAV',
        'EBV',
        'research_done',
        'date_research',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function doctor()
    {
        return $this->hasOne(User::class,'id','specialist');
    }
    public function Attending_doctor()
    {
        return $this->hasOne(User::class,'id','attending_doctor');
    }
    public function departments()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
}
