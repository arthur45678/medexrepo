<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Diagnosis extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'ambulator_diagnosis';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'ambulator_id',
        'user_id',
        'disease_id',
        'diagnosis_comment',
        'diagnosis_date',
        'type'
    ];

    /**
     * Get the ambulator that owns the diagnosis.
     */


    public function ambulator(): BelongsTo
    {
        return $this->belongsTo('App\Models\Ambulator');
    }

    /**
     * Get the user who owns the diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the disease(name, code) for the diagnosis.
     */
    public function disease_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\DiseaseList', "disease_id", "id");
    }
}
