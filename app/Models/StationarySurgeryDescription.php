<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationarySurgeryDescription extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;

    protected static $logName = 'stationary_surgery_descriptions';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "stationary_id",

        "surgery_description_date",
        "surgery_description_comment",
        "surgeon_id",
        "assistant_id",
        "surgical_sister_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function surgeon(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'surgeon_id', 'id');
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'assistant_id', 'id');
    }

    public function surgical_sister(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'surgical_sister_id', 'id');
    }
}
