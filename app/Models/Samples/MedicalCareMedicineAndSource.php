<?php

namespace App\Models\Samples;

use App\Models\MedicineList;
use Illuminate\Database\Eloquent\Model;

class MedicalCareMedicineAndSource extends Model
{
    protected $fillable=[
        'medicine_id',
        'type',
        'source_id',
        'medicine_comments',
        'medicine_count',
        'parent_id',
    ];
    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
}
