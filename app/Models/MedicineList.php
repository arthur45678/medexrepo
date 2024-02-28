<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineList extends Model
{
    use HasCacheableOptions;

    protected $fillable = [
        'code',
        'name',
        'unit',
        'warehouse'
    ];

    public function stationary_medicine_side_effects(): HasMany
    {
        return $this->hasMany("App\Models\StationaryMedicineSideEffect", "medicine_id", "id");
    }

    public function stationary_prescriptions(): HasMany
    {
        return $this->hasMany("App\Models\StationaryPrescription", "medicine_id", "id");
    }
}
