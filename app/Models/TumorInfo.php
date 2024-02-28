<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class TumorInfo extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'ambulator_tumor_info';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'ambulator_id',
        'user_id',

        'tumor_description',
        'tumor_date'
    ];

    /**
     * Get the ambulator that owns the tumor_info.
     */
    public function ambulator(): BelongsTo
    {
        return $this->belongsTo('App\Models\Ambulator');
    }

    /**
     * Get the user who owns the tumor_info.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
