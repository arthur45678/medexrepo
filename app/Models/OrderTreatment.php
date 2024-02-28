<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTreatment extends Model
{
    protected $table = 'order_treatment';

    protected $fillable = ['order_id','treatment_id'];
}
