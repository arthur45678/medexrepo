<?php

namespace App\Models\Samples;

use App\Models\DiseaseList;
use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryInpatientDiagnosis extends Model
{
    use LogsActivity;
    protected static $logName = 'stationary_inpatient_diagnoses';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected $fillable = [
        'inpatient_id',
        'type',
        'disease_id',
        'diagnosis_comment'

  ];

    public function diagnos_name()
    {
        return $this->hasOne(DiseaseList::class, "id", "disease_id");
    }
}
