<?php

namespace App\Models\Samples;

use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PersonalTreatmentMedication extends Model
{    use LogsActivity;

    protected static $logName = 'personal_treatment_medications';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'treatment_id',
        'medicine_id',
        'type',
        'comment',
    ];
    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
}
