<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;

class RegistrationOptionList extends Model
{
    use HasCacheableOptions;

    protected $fillable = ["name", 'status'];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }
}
