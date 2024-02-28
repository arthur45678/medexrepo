<?php

namespace App\Models;

use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\StationaryDiseaseOutcomeEnum;
use Spatie\Enum\Laravel\HasEnums;

class StationaryDiseaseOutcome extends Model
{
    use HasUserId, HasEnums;

    protected static $logName = 'stationary_disease_outcome';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "outcome", "outcome_date", "transferred_clinic_id", "death_circumstance"];

    protected $enums = [
        'outcome' => StationaryDiseaseOutcomeEnum::class,
    ];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function trasferred_clinic(): BelongsTo
    {
        return $this->belongsTo("App\Models\Clinic", "transferred_clinic_id", "id");
    }
}
