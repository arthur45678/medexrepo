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

class DrugDestructionAct extends Model implements ApprovableContract
{
    protected $table = 'drug_destruction_acts';
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $fillable = ['user_id','patient_id','head_doctor_id','pharmacy_manager_id','chief_nurse_id',
        'started_destroying_date','finished_destroying_date','dose','dose_patients',
        ];

    //Գլխավոր բժիշկ
    public function head_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Դեղատան վարիչ
    public function pharmacy_manager(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Գլխավոր բուժքույր
    public function chief_nurse(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }
}
