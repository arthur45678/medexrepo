<?php

namespace App\Models\OtherSamples;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OtherSimplesModel extends Model
{
    protected $fillable = [
        'name',
        'path',
        'table',

    ];

}
