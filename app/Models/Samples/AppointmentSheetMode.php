<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class AppointmentSheetMode extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;

    protected static $logName = 'appointment_sheet_models';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $table = 'appointment_sheet_models';
    protected $fillable = ["user_id", "patient_id", "department", "hospital_room_number"];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function departments()
    {
        return $this->hasOne(Department::class, "id", "department");
    }
    public function attending_doctor()
    {
        return $this->hasOne(User::class,'id','user_id');
    }


}
