<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Contracts\Models\HasAttachments;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryCellularExamination extends Model implements HasAttachments, ApprovableContract
{
    use HasUserId, LogsActivity, FormatsDateFields, Approvable;

    protected static $logName = 'stationary_cellular_examination';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "examination_comment", "examination_date"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany("App\Models\Attachable", "attachable");
    }
}
