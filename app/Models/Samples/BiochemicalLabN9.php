<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class BiochemicalLabN9 extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'biochemical_lab_n9';

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

        'total_protein',
        'albumin',
        'urine',
        'creatine_man',
        'creatine_wooman',
        'cystatin',
        'uric_acid',
        'total_cholesterol',
        'low_density_lipoproteins',
        'high_density_lipoproteins',
        'triglycerides',
        'total_bilirubin',
        'related_bilirubin',
        'free_bilirubin',
        'glucose',
        'troponin',
        'glycosylated_hemoglobin',
        'insulin',
        'pre_insulin',
        'peptide',
        'alpha_amylase',
        'uroamylase',
        'lipase',
        'basic_phosphatase',
        'acid_phosphatase',
        'gammaglutamyltransferase',
        'aspartateaminotransferase',
        'alanineaminotransferase',
        'lactatedehydrogenase',
        'cholinesterase',
        'creatine_kinase_general_man',
        'creatine_kinase_general_wooman',
        'creatine_kinase',

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
