<?php

namespace App\Models;

use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Prescription extends Model
{
    use HasUserId, LogsActivity;

    protected static $logName = 'ambulator_prescription';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'ambulator_id',
        'health_status_id',

        'medicine_id',
        'medicine_dose',
        'measurement_unit_id',
        'prescription_text',
    ];

    /**
     * Get the health_status that owns the prescriptions.
     */
    public function health_status(): BelongsTo
    {
        return $this->belongsTo('App\Models\HealthStatus');
    }

    public function medicine_item(): BelongsTo {
        return $this->belongsTo('App\Models\MedicineList', "medicine_id", "id");
    }

    public function measurement_unit(): BelongsTo
    {
        return $this->belongsTo('App\Models\MeasurementUnit', "measurement_unit_id", "id");
    }
}
