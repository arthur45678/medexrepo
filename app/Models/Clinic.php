<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasCacheableOptions;

    public $timestamps = false;

    protected $fillable = ['regular_id', 'name', 'code', 'status'];

    protected $casts = [
        "value" => "string"
    ];
}
