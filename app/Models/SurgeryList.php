<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurgeryList extends Model
{
    use HasCacheableOptions;

    protected $fillable = ["code", "name",'status'];

    public function stationary_diagnoses(): HasMany
    {
        return $this->hasMany("App\Models\StationaryDiagnosis");
    }
}
