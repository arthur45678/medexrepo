<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\TumorTreatmentList;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryInpatientRegister extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;


    protected static $logName = 'stationary_inpatient_registers';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'research',
        'patient_id',
        'stationary_id',
        'user_id',
        "treatment_id",
        'payment',
        'payment_info',
        'date',
        'date_discharge',
        'number_days',
        'bed_id',
        'treatment_result',
        'doctor',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function Doctor()
    {
        return $this->hasOne(User::class,'id','doctor');
    }
    public function Tumorlists()
    {
        return $this->hasOne(TumorTreatmentList::class,'id','treatment_id');
    }
}
