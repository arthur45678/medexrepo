<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiseaseList extends Model
{
    use HasCacheableOptions;

    protected $fillable = [
        'chapter',
        'block',
        'code',
        'name',
        'status',
    ];

    /**
     * Get the diagnoses of the disease_list(item).
     */
    public function diagnoses(): HasMany
    {
        return $this->hasMany('App\Models\Diagnosis', "disease_id", "id");
    }

    /**
     * Get the stationary_diagnoses of the disease_list(item).
     */
    public function stationary_diagnoses(): HasMany
    {
        return $this->hasMany('App\Models\StationaryDiagnosis', "disease_id", "id");
    }
}
