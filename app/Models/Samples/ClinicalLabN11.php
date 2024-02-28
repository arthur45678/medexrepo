<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class ClinicalLabN11 extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'clinical_labs_n11';

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

        'hemoglobin_man',
        'hemoglobin_wooman',
        'erythrocytes_man',
        'erythrocytes_wooman',
        'color_index',
        'blood_coagulation',
        'reticulocytes',
        'platelets',
        'leukocytes',
        'blasts',
        'promyelocytes',
        'myelocytes',
        'metamyelocytes',
        'nozzles',
        'segmented_stones',
        'eosinophils',
        'basophils',
        'lymphocytes',
        'monocytes',
        'plasma_cells',
        'erythrocyte_sedimentation_man',
        'erythrocyte_sedimentation_wooman',
        'anisocytosis',
        'poikilocytosis',
        'erythrocytes_with_basophilic',
        'polychromatophilia',
        'jolies_bodies',
        'erythro_normoblasts',
        'megaloblasts',
        'leukocyte_morphology',
        'core_overdose',
        'toxic_granulation',

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
