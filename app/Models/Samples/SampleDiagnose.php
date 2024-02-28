<?php

namespace App\Models\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Models\Samples\RadiationTreatmentCard;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;
use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SampleDiagnose extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, Approvable;
    protected $table = 'sample_diagnoses';

    protected $fillable = [
        'card_id','diagnosable_type', 'user_id',  'disease_id', 'diagnosis_comment', 'diagnosis_date',
    ];

    protected $enums = [
        "diagnosable_type" => SampleDiagnosesEnum::class,
    ];

    public function getDiagnosisTypeValueAttribute(): string
    {
        return $this->diagnosable_type->getValue();
    }

    protected static $logName = 'sample_diagnosis';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];


    public function diagnosable(): MorphTo
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
     * Get the disease(name, code) for the diagnosis.
     */
    public function disease_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\DiseaseList', "disease_id", "id");
    }


    // public function radiationCart(): BelongsTo
    // {
    //     return $this->belongsTo(RadiationTreatmentCard::class);
    // }
    // public function radiationCart(): BelongsTo
    // {
    //     return $this->belongsTo(RadiationTreatmentCard::class);
    // }

    public static function getPatomorphDiseasies($card_id)
    {
        return self::where(['disease_id' => $card_id, 'user_id' => Auth::user()->id, 'diagnosable_type' => SampleDiagnosesEnum::patomorph_disease()])->get();
    }

}
