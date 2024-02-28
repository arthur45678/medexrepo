<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class FemaleIssue extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'ambulator_female_issue';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'ambulator_id',
        'user_id',

        'number_of_births',
        'number_of_abortions',
        'date_of_last_birth',
        'breastfeeding_complications',
        'breast_inflammation',
        'menstruation',
        'menstruation_date'
    ];

    /**
     * Get the ambulator that owns the female_issue.
     */
    public function ambulator(): BelongsTo
    {
        return $this->belongsTo('App\Models\Ambulator');
    }

    /**
     * Get the user who owns the female_issue.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
