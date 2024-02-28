<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\HasUserId;
use Spatie\Enum\Laravel\HasEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

use App\Enums\StationaryTreatmentEvaluation\EasternCooperativeOncologyGroupEnum;
use App\Enums\StationaryTreatmentEvaluation\KarnofskyPerformanceScaleEnum;
use App\Enums\StationaryTreatmentEvaluation\TreatmentEffectivenessEnum;
use App\Traits\Approvable;

class StationaryTreatmentEvaluation extends Model implements ApprovableContract
{
    use HasUserId, HasEnums, LogsActivity, Approvable;
    protected static $logName = 'stationary_treatment_evaluation';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "stationary_id",

        "eastern_cooperative_oncology_group",
        "karnofsky_performance",
        "treatment_effectiveness"
    ];

    protected $enums = [
        "eastern_cooperative_oncology_group" => EasternCooperativeOncologyGroupEnum::class . ':nullable',
        "karnofsky_performance" => KarnofskyPerformanceScaleEnum::class . ':nullable',
        "treatment_effectiveness" => TreatmentEffectivenessEnum::class . ':nullable',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
