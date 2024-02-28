<?php

namespace App\Models\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
use App\Models\Samples\RadiationTreatmentCard;
use App\Models\TreatmentList;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;
use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SampleTreatments extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, Approvable;
    protected $table = 'sample_treatments';
    protected $fillable = [
        'treatable_id', 'treatable_type', 'user_id', 'treatments_type', 'treatment_id', 'treatment_comment', 'treatment_date',
    ];

    protected $enums = [
        "treatments_type" => SampleTreatmentsEnum::class,
    ];

    public function getTreatmentsTypeValueAttribute(): string
    {
        return $this->treatments_type->getValue();
    }

    protected static $logName = 'sample_treatments';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];


    public function treatable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who owns the diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the treatment(name, code) for the treatment.
     */
    public function treatment_item(): BelongsTo
    {
        return $this->belongsTo(TreatmentList::class, "treatment_id", "id");
    }

    public static function getConcomitantTreatments($card_id)
    {
        return self::where(['card_id' => $card_id, 'user_id' => Auth::user()->id,
            'treatments_type' => SampleTreatmentsEnum::concomitant_treatment(),])->get();

    }


}
