<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class InventoryAccounting extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'inventory_accounting';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'bandage_nurse_id',
        'chief_nurse_id',
        'date',
        'entry_date',
        'manipulation',
        'get_from',
        'bandages',
        'bandag',
        'tanzif',
        'alcohol',
        'hydrogen_peroxide',
        'povidonioditis',
        'sodium_chloride',
        'furacillin',
        'adhesive_tape',
        'glove',
    ];

      /**
     * Relation to the patient
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

    public function bandage_nurse(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function chief_nurse(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "chief_nurse_id", "id");
    }

   

}
