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


class ConsciousVoluntaryConsent extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected $table = 'conscious_voluntary_consents';
    protected $fillable = ['command_number','user_id','patient_id','admission_date','medicine_id','payment_type','firstName_lastName_patronymic',
        'treatment_description','department_head_doctor_id','doctor_id','client_confirm_date'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

    public function department_head_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function medicine_item(): BelongsTo {
        return $this->belongsTo('App\Models\MedicineList', "medicine_id", "id");
    }

    public function getDragsName()
    {
        $str = '';
        $items = $this->medicine_item()->get();

        foreach ($items as $item){
            $str .= $item->name . ' ,';

        }
        $drugsName = trim($str);
        return $drugsName;

    }


}
