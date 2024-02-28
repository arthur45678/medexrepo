<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasUserId;

class PatientFirstInfo extends Model
{
    use HasUserId, LogsActivity;

    protected static $logName = 'patient_first_info';

    protected static $logAttributes = ["*"];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

    protected $fillable = [
        'patient_id',
        'first_clinic',
        'first_clinic_date',
        'first_discovered',
        'first_discovered_date',
        'past_treatments',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function first_clinic_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\Clinic','first_clinic','id');
    }

    public function first_discovered_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\Clinic','first_discovered','id');
    }

    /**
     * Get the user who owns the patient_first_info.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

}
