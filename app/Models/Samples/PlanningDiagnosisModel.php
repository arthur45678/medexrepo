<?php

namespace App\Models\Samples;

use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PlanningDiagnosisModel extends Model
{
    use LogsActivity;

    protected static $logName = 'planning_diagnosis_models';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'planning_id',
        'disease_id',
        'diagnosis_comment',
    ];

    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "disease_id");
    }
}
