<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\ReferralService;

class PaidService extends Model
{
    use LogsActivity; // HasCacheableOptions

    protected static $logName = 'paid_services';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'key_one',
        'key_two',
        'code',
        'name',
        'cost',
        'status'
    ];

    public function referral_service(): MorphOne
    {
        return $this->morphOne(ReferralService::class, 'serviceable');
    }
}
