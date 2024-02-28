<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentStageList extends Model
{
    protected $fillable = [

        'name',
        'status'
    ];
}
