<?php

namespace App\Models\Samples;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class Reference extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'references';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'attending_doctor_id',
        'department_head_id',
        'chief_doctor_id',
        'date',
        'reference_diagnosis',
        'treatment',
        'doctor_advice',
        'from_date',
        'to_date',
       
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
     * Relation to the attending_doctor (Բաժնի վարիչ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

      /**
     * Relation to the attending_doctor (Գլխավոր բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chief_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

}
