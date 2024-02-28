<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationarySocialPackage extends Model
{
    use HasUserId, LogsActivity;

    protected static $logName = 'stationary_social_package';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "stationary_id",
        "social_package_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function package_item(): BelongsTo
    {
        return $this->belongsTo("App\Models\SocialPackage", "social_package_id", "id");
    }

}
