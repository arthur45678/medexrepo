<?php

namespace App\Models;

use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryPrescription extends Model
{
    use HasUserId, LogsActivity;
    protected static $logName = 'stationary_prescription';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "patient_id",
        "stationary_id",
        "stationary_disease_course_id",

        "medicine_id",
        "medicine_dose",
        "measurement_unit_id",
        "prescription_text"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function stationary_disease_course(): BelongsTo
    {
        return $this->belongsTo("App\Models\StationaryDiseaseCourse", "stationary_disease_course_id", "id");
    }

    public function medicine_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\MedicineList', "medicine_id", "id");
    }

    public function measurement_unit(): BelongsTo
    {
        return $this->belongsTo('App\Models\MeasurementUnit', "measurement_unit_id", "id");
    }
}
