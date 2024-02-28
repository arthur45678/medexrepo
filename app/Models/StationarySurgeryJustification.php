<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationarySurgeryJustification extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, Approvable;

    protected static $logName = 'stationary_surgery_justification';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "justification",
        "date",
        "stationary_id",
        "user_id",
        "attending_doctor_id",
        "department_head_id",
        "medical_affairs_deputy_director_id"
    ];

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "attending_doctor_id", "id");
    }

    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "department_head_id", "id");
    }

    public function medical_affairs_deputy_director(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "medical_affairs_deputy_director_id", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
