<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageList extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'group',
        'status'
    ];
}
