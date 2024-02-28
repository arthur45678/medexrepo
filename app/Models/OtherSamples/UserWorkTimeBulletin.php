<?php

namespace App\Models\OtherSamples;

use Illuminate\Database\Eloquent\Model;

use App\Traits\FormatsDateFields;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkTimeBulletin extends Model
{
    use FormatsDateFields, LogsActivity;

    protected static $logName = 'user_worktime_bulletin';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'department_work_time_bulletin_id',
        'worktime'
    ];

    protected $with = [
        'user'
    ];

    # relations
    // user-bulletin belongs to this user
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    //  department-bulletin, which contains this user-bulletin
    public function department_work_time_bulletin(): BelongsTo
    {
        return $this->belongsTo('App\Models\OtherSamples\DepartmentWorkTimeBulletin');
    }
}
