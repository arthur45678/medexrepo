<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryDiseaseCourse extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;
    protected static $logName = 'stationary_disease_course';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected $with = [
        'stationary_prescriptions',
        'stationary_prescriptions.medicine_item',
        'stationary_prescriptions.measurement_unit',
    ];

    protected $fillable = [
        "user_id",
        "stationary_id",

        "disease_course_date",
        "disease_course_comment"
    ];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function stationary_prescriptions(): HasMany
    {
        return $this->hasMany("App\Models\StationaryPrescription");
    }
}
