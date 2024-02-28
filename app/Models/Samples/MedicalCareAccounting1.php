<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\Scholarships_list;
use App\Models\ServiceList;
use App\Models\Stationary;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class MedicalCareAccounting1 extends Model implements ApprovableContract
{
    protected $table = 'medical_care_accounting1s';
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected $fillable = [
        'patient_id',
        'user_id',
        'responsible_nurse',
        'department_id',
        'moved_department_id',
        'case_status',
        'social_package_comments',
        'social_package_id',
        'tickets_N',
        "clinic_id",
        "clinic_comments",
        "referral_N",
        "ReportNumberN",
        'service_id',
        'scholarships_id',
        'replenishment_type',
        'replenishment_size',
        "stationary_id",
        'moved_department2_id',
        'date',
        'c',
        "clinic2_id",
        'service2_id',
        'service3_id',
        'scholarships2_id',
        'scholarships3_id',
        'field_comments',
        'hospital_department_id',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    public function ResponsibleNurse()
    {
        return $this->hasOne(User::class, 'id', 'responsible_nurse');
    }
    public function stationary_Name()
    {
        return $this->hasOne(Stationary::class, 'id', 'stationary_id');
    }

    public function Department_Name()
    {
        return $this->hasOne(Department::class, 'id', 'moved_department_id');
    }
    public function Department_Hospital_Name()
    {
        return $this->hasOne(Department::class, 'id', 'hospital_department_id');
    }

    public function Clinic_Name()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }
    public function Clinic2_Name()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic2_id');
    }

    public function Service_Name()
    {
        return $this->hasOne(ServiceList::class, 'id', 'service_id');
    }
    public function Service2_Name()
    {
        return $this->hasOne(ServiceList::class, 'id', 'service2_id');
    }
    public function Service3_Name()
    {
        return $this->hasOne(ServiceList::class, 'id', 'service3_id');
    }

    public function Scholarships2_Name()
    {
        return $this->hasOne(Scholarships_list::class, 'id', 'scholarships2_id');
    }
    public function Scholarships3_Name()
    {
        return $this->hasOne(Scholarships_list::class, 'id', 'scholarships3_id');
    }
    public function Scholarships_Name()
    {
        return $this->hasOne(Scholarships_list::class, 'id', 'scholarships_id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}
