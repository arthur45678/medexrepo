<?php

namespace App\Models\Samples;

use App\Models\DiseaseList;
use App\Models\MedicineList;
use App\Models\TreatmentList;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AnesthesiologDiagnosis extends Model
{
    use LogsActivity;
    protected static $logName = 'anesthesiolog_diagnoses';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'anesthesiolog_id',
        'treatment_id',
        'type',
        'surgeries_comment',
        'treatment_id',
        'disease_id'
        ];
    public function disease_name()
    {
        return $this->hasOne(DiseaseList::class, "id", "disease_id");
    }
    public function treatment_name()
    {
        return $this->hasOne(TreatmentList::class, "id", "treatment_id");
    }
}
