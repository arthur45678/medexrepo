<?php

namespace App\Models\Samples;

use App\Models\TreatmentList;
use Illuminate\Database\Eloquent\Model;

class IndividualTreatmentPlansTreatmentList extends Model
{
    protected $fillable = [
        "parent_id",
        "treatment_id",
        "treatment_comment",
        "type",
    ];



    public function TreatmentLists()
    {
        return $this->hasOne(TreatmentList::class,'id','treatment_id');
    }
}
