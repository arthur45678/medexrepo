<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ImmunologicalExaminationPatternN7 extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;

    protected static $logName = 'immunological_n7_s';

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
        'AFP',
        'TPSA',
        'FPSA',
        'CEA',
        'CA19',
        'CA15',
        'CA125',
        'CA72',
        'NSE',
        'Cyfra',
        'b-hCG',
        'SCC',
        'b-2MG',
        'research-was-done',
        'date_research',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function attendingdoctor()
    {
        return $this->hasOne(User::class, 'id', 'attending_doctor');
    }

    public function doctor()
    {
        return $this->hasOne(User::class, 'id', 'specialist');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
