<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Models\User;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class MicrobiologyExamination_Form_2 extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'microbiology_examinations_form_2';
    protected $fillable = ['user_id','patient_id','medical_company_name','examination_date', 'department_id','room','referred_doctor_id',
        'card_number','sterilisation','tif_infection_info','attending_doctor_id','test_response_date',
        ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    //բուժող բժիշկ
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Ուղեգրող բժիշկ
    public function referred_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","referred_doctor_id","id");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }
}
