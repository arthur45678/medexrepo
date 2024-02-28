<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    protected $table = 'cashboxes';
    protected $fillable = ['name','slug'];

    public function orderOutput()
    {
        return $this->hasMany(OrderOutput::class);
    }

    //orderInput
    public function orderInput()
    {
        return $this->hasMany(Order::class);
    }

}
