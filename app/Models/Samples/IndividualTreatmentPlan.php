<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\SurgeryList;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class IndividualTreatmentPlan extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'individual_treatment_plans';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'patient_id',
        'user_id',
        'department_id',
        'manipulation',
        "surgery_id",
        "surgery_comment",
        'entry_date',
        'get_from',
        'histological_other_comment',
        'other_interventions',
        'intermediate_control',
        'surgical_after_surgical_comment',
        'doctor_surgical_id',
        'doctor_surgical_comment',
        'surgical_present_comment',
        'after_chemotherapy_comment',
        'doctor_chemotherapy_id',
        'doctor_chemotherapy_comment',
        'chemotherapy_present_comment',
        'doctor_radiation_id',
        'doctor_radiation_comment',
        'radiation_present_comment',
        'radiation_other_comment',
        'after_control_comment',
        'doctor_control_id',
        'doctor_control_comment',
        'control_present_comment',
        'control_other_comments',
        'treatment_date',
        'doctor_oncologist_id',
        'surgeon_oncologist_id',
        'chemotherapist_id',
        'histologist_id',
        'radiologist_id',
        'radiologist_specialist_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function OncologistDoctor()
    {
        return $this->hasOne(User::class,'id','doctor_oncologist_id');
    }
    public function SurgeonOncologistDoctor()
    {
        return $this->hasOne(User::class,'id','surgeon_oncologist_id');
    }
    public function ChemotherapistOncologistDoctor()
    {
        return $this->hasOne(User::class,'id','chemotherapist_id');
    }
    public function HistologistOncologistDoctor()
    {
        return $this->hasOne(User::class,'id','histologist_id');
    }
    public function RadiologistOncologistDoctor()
    {
        return $this->hasOne(User::class,'id','radiologist_id');
    }
    public function RadiologistSpecialistDoctor()
    {
        return $this->hasOne(User::class,'id','radiologist_specialist_id');
    }
    public function SurgicaltDoctor()
    {
        return $this->hasOne(User::class,'id','doctor_surgical_id');
    }
    public function ChemotherapyDoctor()
    {
        return $this->hasOne(User::class,'id','doctor_chemotherapy_id');
    }
    public function RadiationDoctor()
    {
        return $this->hasOne(User::class,'id','doctor_radiation_id');
    }
    public function ControlDoctor()
    {
        return $this->hasOne(User::class,'id','doctor_control_id');
    }
    public function SurgeryLists()
    {
        return $this->hasOne(SurgeryList::class,'id','surgery_id');
    }



}
