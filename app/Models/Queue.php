<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Traits\UsesUuId;

/**
 * each user can have many queues
 * each patient can have many queues
 * each referral can have one queue , like a service
 */

class Queue extends Model
{
    use UsesUuId;

    protected $fillable = [
        'number',
        'is_urgent',
        'referral_id',

        'nonMedicalReferrals',
        'user_id',
    ];

    // protected $with = ['referral'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo('App\Models\Referral');
    }
}
