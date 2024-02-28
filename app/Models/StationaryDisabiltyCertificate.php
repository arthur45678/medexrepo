<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryDisabiltyCertificate extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;

    protected static $logName = 'stationary_disabilty_certificate';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "number", "from", "to"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
