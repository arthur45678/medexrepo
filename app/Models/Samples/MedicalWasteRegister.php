<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Models\Department;
use App\Traits\Approvable;
use App\Models\User;
use Illuminate\Http\Request;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;

class MedicalWasteRegister extends Model implements ApprovableContract
{
    protected $table = 'medical_waste_registers';
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected $fillable = ['user_id', 'patient_id', 'department_id', 'waste_type', 'admission_date',
        'emergency_registration', 'date_of_registration', 'move_date', 'type_emergency_situation', 'responsible_for_waste_doctor_id',
        'waste_handler_doctor_id', 'receiver_waste_doctor_id',];

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }

    // Բժշկական թափոնի պատասխանատու
    public function responsible_for_waste_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","responsible_for_waste_doctor_id","id");
    }


    // Բժշկական թափոնի հանձնող
    public function waste_handler_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","waste_handler_doctor_id","id");
    }


    // Բժշկական թափոնի ընդունող
    public function receiver_waste_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","receiver_waste_doctor_id","id");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }



}
