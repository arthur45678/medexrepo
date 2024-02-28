<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\TreatmentList;
use App\Traits\Approvable;
use App\Models\User;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class SurgeryParticipants extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'surgery_participants';
    protected $fillable = ['user_id','patient_id','attending_doctor_id', 'treatment_id','department_id','coverage',
        'reanimatolog_doctor_id', 'anastesiology_nurse_id','surgery_nurse_id','medical_orderly_id','assistant_doctor_id','anesthesiologist_doctor_id',
        ];


    //բուժող բժիշկ
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    // Ռեանիմատոլոգ
    public function reanimatolog_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Վիրահատարանի բ/ք
    public function surgery_nurser(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Վիրահատարան մայրապետ
    public function medical_orderly(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Ասիստենտ
    public function assistant_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }


    //Անեսթեզիոլոգ
    public function anesthesiologist_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }




    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }

    public function treatment_item(): BelongsTo
    {
        return $this->belongsTo(TreatmentList::class, "treatment_id", "id");
    }

}
