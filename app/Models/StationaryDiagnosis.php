<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\StationaryDiagnosisEnum;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Spatie\Enum\Laravel\HasEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryDiagnosis extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, Approvable;

    protected $fillable = [
        "stationary_id",
        "user_id",

        "disease_id",
        "diagnosis_type",
        "diagnosis_comment",
        "diagnosis_date"
    ];

    protected $enums = [
        "diagnosis_type" => StationaryDiagnosisEnum::class,
    ];

    public function getDiagnosisTypeValueAttribute(): string
    {
        return $this->diagnosis_type->getValue();
    }

    protected static $logName = 'stationary_diagnosis';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    /**
     * Get the user who owns the diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the disease(name, code) for the diagnosis.
     */
    public function disease_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\DiseaseList', "disease_id", "id");
    }
}
