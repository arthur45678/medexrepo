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

class Echocardiogram extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'echocardiograms';
    protected $fillable = ['user_id','patient_id','patient_age','admission_date','diastolic_size_KDR',
        'diastolic_size_KCR','diastolic_size_KDO','diastolic_size_KCO','back_wall','interventricular_septum','extraction_fraction',
        'AP_diastolic_size','AP_wall_norma','aortic_roo_diameter','left_atrium_diameter','small_size_of_the_left_atrium',
        'collapse_of_the_lower_eyelid', 'decision','attending_doctor_id',];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }


}
