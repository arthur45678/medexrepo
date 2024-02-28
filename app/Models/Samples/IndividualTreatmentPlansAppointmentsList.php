<?php

namespace App\Models\Samples;

use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;

class IndividualTreatmentPlansAppointmentsList extends Model
{
    protected $fillable = [
        "parent_id",
        'medicine_id',
        'appointments_comments',
        'type',
    ];
    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
}
