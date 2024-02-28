<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceList extends Model
{
    use HasCacheableOptions, LogsActivity;


    protected static $logName = 'service_list';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'code',
        'name',
        'price',
        'status',
        'department_id',
    ];

    protected $appends = [
        "pivot_payment_type_translated"
    ];

    /**
     * Relation to the referrals, where defined services as todo-list
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function referrals(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Referral', 'referral_service', 'service_list_id', 'referral_id')
            ->withPivot('payment_type', 'comment')->withTimestamps();
    }

    public function pivot_payment_type() {
        return $this->pivot->payment_type ?? null;
    }

    public function getPivotPaymentTypeAttribute()
    {
        return $this->pivot_payment_type();
    }

    public function getPivotPaymentTypeTranslatedAttribute()
    {
        $payment_type =  $this->pivot_payment_type();
        return $payment_type ? __("enums.service_payment_type_enum.{$this->pivot_payment_type()}") : $payment_type;
    }
}
