<?php

namespace App\Models\Samples;

use App\Models\ServiceList;
use Illuminate\Database\Eloquent\Model;

class IndividualTreatmentPlansService extends Model
{
    protected $fillable = [
        "parent_id",
        'service_id',
        'type',
        'comment',
    ];

    public function ServiceLaboratory(){
        return $this->hasOne(ServiceList::class,'id','service_id');

    }
    public function ServiceInstrumental(){
        return $this->hasOne(ServiceList::class,'id','service_id');

    }
    public function ServiceRadiation(){
        return $this->hasOne(ServiceList::class,'id','service_id');

    }
    public function ServiceHistological(){
        return $this->hasOne(ServiceList::class,'id','service_id');

    }
}
