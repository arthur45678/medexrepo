<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class ClinicalLabN12 extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'clinical_labs_n12';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'department_id',
        'attending_doctor_id',
        'sender_doctor_id',
        'stationary_id',
        'bbe_number',
        'chamber',
        'biopsy_date',

        'count_l',
        'count_ml',
        'color',
        'transparency',
        'relative_density',
        'reaction',
        'protein_gl',
        'protein_g',
        'glucose_mmol',
        'glucose_g',
        'ketone_bodies',
        'hemoglobin',

        'bilirubin',
        'urobilinoids',
        'bile_acids',
        'indica',

        'flat',
        'transitional',
        'renal',
        'leukocytes',
        'erythrocytes',

        'erythrocytes_bool',

        'hyalina',
        'granular',
        'wax',
        'epithelial',
        'leukocyte',
        'erythrocytar',
        'pigmented',
        'mucus',
        'salts',
        'bacteria',

        'research_date',
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

    public function sender_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "sender_doctor_id", "id");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }
}
