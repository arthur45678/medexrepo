<?php

namespace App\Models\Samples;

use App\Models\TreatmentList;
use Illuminate\Database\Eloquent\Model;

class ExtractTreatmentList extends Model
{
    protected $fillable=[
        'parent_id',
        "treatment_id",
        "treatment_comments",
        "type",
    ];

    public function TreatmentList()
    {
        return $this->hasOne(TreatmentList::class, 'id', 'treatment_id');
    }
}
