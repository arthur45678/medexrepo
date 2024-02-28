<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryResuscitationDepartment extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, FormatsDateFields, Approvable;

    protected static $logName = 'stationary_resuscitation_department';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "comment", "date"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
