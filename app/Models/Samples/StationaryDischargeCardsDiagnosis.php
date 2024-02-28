<?php

namespace App\Models\Samples;

use App\Models\DiseaseList;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StationaryDischargeCardsDiagnosis extends Model
{
    use LogsActivity;


    protected static $logName = 'stationary_discharge_cards_diagnoses';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
    'parent_id',
    'disease_id',
    'type',
    'diagnoses_comments',
];
    public function disease_name()
    {
        return $this->hasOne(DiseaseList::class, "id", "disease_id");
    }
}
