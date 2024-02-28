<?php

namespace App\Models\Samples;

use App\Models\LabServiceList;
use Illuminate\Database\Eloquent\Model;

class MedicalCareMedicineLabService extends Model
{
    protected $fillable = [
        'parent_id',
        'lab_service_id',
        'lab_comments',
        'lab_count',
        'lab_service_id',
    ];

    public function LabServiceName()
    {
        return $this->hasOne(LabServiceList::class, "id", "lab_service_id");


    }
}
