<?php

namespace App\Models\OtherSamples;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepartmentWorkTimeBulletin extends Model
{
    use HasUserId, FormatsDateFields, LogsActivity;

    protected static $logName = 'department_worktime_bulletin';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'department_id'
    ];

    # relations
    // bulletin creator-user
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    // bulletin owner-department
    public function department(): BelongsTo
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function user_work_time_bulletins(): HasMany
    {
        return $this->hasMany("App\Models\OtherSamples\UserWorkTimeBulletin");
    }

    public static function default_worktime(): array
    {
        $worktime = [
            'summary' => ['h' => 0, 'm' => 0],
            'month_days' => [
                1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '',
                7 => '', 8 => '', 9 => '', 10 => '', 11 => '', 12 => '',
                13 => '', 14 => '', 15 => '', 16 => '', 17 => '', 18 => '',
                19 => '', 20 => '', 21 => '', 22 => '', 23 => '', 24 => '',
                25 => '', 26 => '', 27 => '', 28 => '', 29 => '', 30 => '',
                31 => ''
            ],

            'idle_summary' => ['h' => 0, 'm' => 0],
            'month_idle_days' => [
                1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '',
                7 => '', 8 => '', 9 => '', 10 => '', 11 => '', 12 => '',
                13 => '', 14 => '', 15 => '', 16 => '', 17 => '', 18 => '',
                19 => '', 20 => '', 21 => '', 22 => '', 23 => '', 24 => '',
                25 => '', 26 => '', 27 => '', 28 => '', 29 => '', 30 => '',
                31 => ''
            ]
        ];

        return $worktime;
    }
}
