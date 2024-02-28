<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LampOperationMode extends Model implements ApprovableContract
{
    use LogsActivity,Approvable, FormatsDateFields;

    protected static $logName = 'lamp_operation_modes';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'patient_id',
        'user_id',
        'responsible_nurse',
        'date',
        'title',
        'regime',
        'opening_start',
        'opening_end',
        'regime_description',
    ];
    public function nurse()
    {
        return $this->hasOne(User::class,'id','responsible_nurse');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
