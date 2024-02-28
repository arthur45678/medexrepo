<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialLivingConditionList extends Model
{
    use HasCacheableOptions;
    protected $fillable = ['name', 'status'];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
