<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialPackage extends Model
{
    use HasCacheableOptions;
    protected $fillable = ['id', 'pkey', 'name'];


    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function stationary_social_packages(): HasMany
    {
        return $this->hasMany("App\Models\StationarySocialPackage");
    }
}
