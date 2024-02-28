<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientConnection extends Model
{
    protected $fillable = ["sender_id", "receiver_id", "patient_id", "department_id"];


    public function referral(): HasOne
    {
        return $this->hasOne('App\Models\Referral');
    }
}
