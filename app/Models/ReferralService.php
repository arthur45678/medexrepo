<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

class ReferralService extends Model
{
    use LogsActivity;

    protected static $logName = 'referral_services';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'referral_id',
        'serviceable_id',
        'serviceable_type',
        'payment_type',
        'comment'
    ];

    protected $appends = [
        "payment_type_translated"
    ];

    /**
     * Relation to the referral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referral(): BelongsTo
    {
        return $this->belongsTo('App\Models\Referral', 'referral_id', 'id');
    }

    /**
     * Relation associated with PaidService and StateOrderedService
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceable(): MorphTo
    {
        return $this->morphTo();
    }


    public function payment_type() {
        return $this->attributes['payment_type'] ?? null;
    }

    public function getPaymentTypeAttribute()
    {
        return $this->payment_type();
    }

    public function getPaymentTypeTranslatedAttribute()
    {
        $payment_type =  $this->payment_type();
        return $payment_type ? __("enums.service_payment_type_enum.{$this->payment_type()}") : $payment_type;
    }
}
