<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDepartment extends Model
{
    protected $table = 'order_department';
    protected $fillable = ['order_id','department_id'];
}
