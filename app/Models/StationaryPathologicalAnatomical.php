<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Contracts\Models\HasAttachments;
use App\Traits\Approvable;

class StationaryPathologicalAnatomical extends Model implements HasAttachments, ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;
    protected static $logName = 'stationary_pathological_anatomical';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $table = 'stationary_pathological_anatomicals';
    protected $fillable = [
        "user_id",
        "stationary_id",


        "autopsy_date",
        "autopsy_protocol",
        "cause_of_death",
        "pathological_anatomical_epicrisis"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany("App\Models\Attachable", "attachable");
    }
}
