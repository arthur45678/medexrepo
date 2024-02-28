<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOutputTreatment extends Model
{
    protected $table = 'orderOutput_treatment';
    protected $fillable = ['order_id','department_id'];
}
