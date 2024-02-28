<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class HealthStatus extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'ambulator_health_status';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $with=[
        'prescriptions',
        'prescriptions.medicine_item',
        'prescriptions.measurement_unit',
    ];
    protected $fillable = [
        'user_id',
        'ambulator_id',

        'health_status_date',
        'health_status_text',
    ];

    /**
     * Get the ambulator that owns the health_status.
     */
    public function ambulator(): BelongsTo
    {
        return $this->belongsTo('App\Models\Ambulator');
    }

    /**
     * Get the user who owns the health_status.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the prescriptions for the health_status.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany('App\Models\Prescription');
    }
}
