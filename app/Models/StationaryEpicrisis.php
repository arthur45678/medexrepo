<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Contracts\Models\HasAttachments;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryEpicrisis extends Model implements HasAttachments, ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;

    protected static $logName = 'stationary_epicrisis';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "stationary_id",

        "epicrisis",
        "epicrisis_date",

        "attending_doctor_id",
        "department_head_id",
        "chief_doctor_id"
    ];

    public function getFormattedDate($attribute, $format = "Y-m-d"): string
    {
        return Carbon::parse($this->attributes[$attribute])->format($format);
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany("App\Models\Attachable", "attachable");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "attending_doctor_id", "id");
    }

    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "department_head_id", "id");
    }

    public function chief_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "chief_doctor_id", "id");
    }
}
