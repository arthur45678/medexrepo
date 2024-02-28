<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Traits\UsesUuId;

class Queue extends Model
{
    use UsesUuId;

    /**
     * number
     * enqueue_date
     * comment
     * expired
     *
     * user_id
     * patient_id
     * department_id
     */
    protected $guarded = [];
    protected $table = 'api_queues';

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo('App\Models\Api\Patient');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo('App\Models\Department');
    }


}
