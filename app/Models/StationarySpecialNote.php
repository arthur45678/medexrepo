<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;

use App\Contracts\Models\HasAttachments;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;

class StationarySpecialNote extends Model implements HasAttachments, ApprovableContract
{
    use HasUserId, LogsActivity, FormatsDateFields, Approvable;
    protected static $logName = 'stationary_special_note';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "stationary_id",

        "special_note_date",
        "special_note_comment"
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
