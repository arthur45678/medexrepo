<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;

class AgeList extends Model
{
    use HasCacheableOptions;

    protected $fillable = [
        'age_from', 'age_to', 'age_code', 'status'
    ];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "age_from as from", "age_to as to"];
    }
}
