<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class NamesMaterialValues extends Model
{
    protected $fillable = ["name", "code", "unit"];
}
