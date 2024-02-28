<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistologicalList extends Model
{
    protected $fillable = [
        'code',
        'name',
        'status'
    ];
}
