<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MeasurementUnit extends Model
{
    use HasCacheableOptions;

    protected $fillable = [
        'code',
        'name'
    ];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function stationary_prescription() : HasOne {
        return $this->hasOne('App\Models\StationaryPrescription');
    }
}
