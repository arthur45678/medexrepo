<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarModel extends Model
{
    protected $fillable = [
        'referral_id',
        'user_id',
        'status',
        'patient_id',
        'start',
        'end',
        'name',
        'comments'
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }
}
