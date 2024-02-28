<?php

namespace App\Models\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleSurgeriesEnum;
use App\Models\Samples\RadiationTreatmentCard;
use App\Models\SurgeryList;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;
use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SampleSurgeries extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, Approvable;
    protected $table = 'sample_surgeries';
    protected $fillable = [
        'surgeryable_type', 'surgeryable_id', 'user_id', 'surgeries_type', 'surgery_id', 'surgeries_comment', 'surgeries_date',
    ];

    protected $enums = [
        "surgeries_type" => SampleSurgeriesEnum::class,
    ];

    public function getSurgeriesTypeValueAttribute(): string
    {
        return $this->surgeries_type->getValue();
    }

    protected static $logName = 'sample_surgeries';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    public function surgeryable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who owns the surgeries.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the surgery(name, code) for the surgeries.
     */
    public function surgery(): BelongsTo
    {
        return $this->belongsTo(SurgeryList::class, "surgery_id", "id");
    }
}
