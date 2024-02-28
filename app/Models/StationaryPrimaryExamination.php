<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryPrimaryExamination extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable;

    protected $fillable = [
        "user_id",
        "stationary_id",
        "examination_date",
        "complaints",
        "anamnesis_morbi",
        "growth_and_development",
        "inheritance",
        "sextual_history",

        "menarche_age",
        "last_mensis",
        "menopausa_age",
        "number_of_pregnancies",
        "number_of_abortions",
        "number_of_interruptions",
        "number_of_births",

        "breast_feeding",
        "breast_feeding_comment",

        "taking_hormonal_drugs",
        "taking_hormonal_drugs_comment",
    ];

    protected $casts = [
        // "breast_feeding" => "boolean",
        // "taking_hormonal_drugs" => "boolean",
    ];

    protected static $logName = 'stationary_primary_examination';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = true; // Check in documentation

    public function getFormattedDate($attribute, $format = "Y-m-d"): string
    {
        // if (!isset($this->attributes[$attribute]) or empty($this->attributes[$attribute]))
        //     return "";

        return Carbon::parse($this->attributes[$attribute])->format($format);
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
