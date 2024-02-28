<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasUserId;

class Attendance extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'ambulator_attendance';
    protected static $logAttributes = ['*'];

    public $timestamps = false;
    // protected $casts = [
    //     'attendance_date' => 'date',
    // ];
    protected $fillable = [
        'ambulator_id',
        'user_id',
        'attendance_date'
    ];

    /**
     * Get the ambulator that owns the attendances.
     */
    public function ambulator(): BelongsTo
    {
        return $this->belongsTo('App\Models\Ambulator');
    }

    /**
     * Get the user who owns the attendance.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
