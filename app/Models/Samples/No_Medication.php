<?php

namespace App\Models\Samples;

use App\Models\Department;
use App\Models\Diagnosis;
use App\Models\diagnostic\DiagnosticAppointmentModels;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class No_Medication extends Model
{
    use LogsActivity;

    protected static $logName = 'no_medications';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    public $table = 'no_medications';
    protected $fillable = [
        'appointment_sheet_id',
        'diagnostic_appointment_models',
        'appointment_date',
        'end_day',
        ];


    public function diagnostic()
    {
        return $this->hasOne(DiagnosticAppointmentModels::class, "id", "diagnostic_appointment_models");
    }
}
