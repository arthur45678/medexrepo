<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class SterilizationModeSister extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'sterilization_mode_sister';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'attending_doctor_id',

        'main_date',
        'name',
        'count',
        'cleaning_method',
        'cleaning_method_name',
        'disinfection_method',
        'axt_name',
        'according',
        'start',
        'end',
        'nax_name',
        'nax_count',
        'processing_number',
        'presence_blood',
        'traces_detergent',
        'medical_name',
        'medical_count',
        'sterilizer_tool_time',
        'steril_tool_time',
        'steril_tool_temperature',
        'steril_tool_endtime',
        'steril_tool_removetime',
        'control_sterilizers',
        'medical_tools_name',
        'medical_tools_count',
        'medical_itemsname_disinfectant',
        'steril_prep_date',
        'test_result',
        'steril_material_time',
        'steril_mode_start',
        'steril_mode_end',
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

}
