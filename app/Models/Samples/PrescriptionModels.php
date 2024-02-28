<?php

namespace App\Models\Samples;

use App\Models\Department;
use App\Models\MeasurementUnit;
use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PrescriptionModels extends Model
{
    use LogsActivity;

    protected static $logName = 'prescription_models';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'appointment_sheet_id',
        'medicine_id',
        'medicine_dose',
        'measurement_unit_id',
        'drugs',
        'prescription_comments',
    ];

    public function MeasurementUnit()
    {
        return $this->hasOne(MeasurementUnit::class, "id", "measurement_unit_id");
    }


    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
}
