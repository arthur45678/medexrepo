<?php

namespace App\Models;

use App\Enums\TumorTreatmentEnum;
use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Enum\Laravel\HasEnums;

class TumorTreatmentList extends Model
{
    use HasCacheableOptions, HasEnums;

    protected $enums = [
        "type" => TumorTreatmentEnum::class
    ];

    protected $fillable = ["name", "type",'status'];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function stationaries(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\TreatmentList", "stationary_tumor_treatment");
    }
}
