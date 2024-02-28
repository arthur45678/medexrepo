<?php

namespace App\Models\Samples;

use App\Models\ServiceList;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PaidServiceContractsServiceAndDoctor extends Model
{
    protected $fillable = [
        'parent_id',
        'service_id',
        'doctor',
        'type',
        'service_comment',
    ];
    public function Doctor_Name()
    {
        return $this->hasOne(User::class, 'id', 'doctor');
    }
    public function Service_Name()
    {
        return $this->hasOne(ServiceList::class, 'id', 'service_id');
    }
}
