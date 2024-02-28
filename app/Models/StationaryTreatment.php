<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StationaryTreatment extends Model implements ApprovableContract
{
    use HasUserId, Approvable;

    protected static $logName = 'stationary_treatment';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["user_id", "stationary_id", "treatment_id", "treatment_comment"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function treatment_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\TreatmentList', "treatment_id", "id");
    }
}
