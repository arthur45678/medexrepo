<?php

namespace App\Models\Samples;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class AwarenessSheet extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'awareness_sheet';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'director_id',
        'attending_doctor_id',
        'department_head_id',
        'service_recipient',
        'accecpt',
        'first_date',
        'second_date',

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

    
     /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

}
