<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasUserId;
use App\Contracts\Models\HasAttachments;
use App\Traits\Approvable;

class StationaryForAnalysis extends Model implements HasAttachments, ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;

    protected static $logName = 'stationary_for_analysis'; // sis -> ses (many)

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "for_analysis_comment", "for_analysis_date"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany("App\Models\Attachable", "attachable");
    }
}
