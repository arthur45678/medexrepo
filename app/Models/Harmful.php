<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Harmful extends Model
{
    use HasCacheableOptions;

    public $timestamps = false;

    protected $casts = ['value' => 'string'];

    protected $fillable = ['regular_id', 'name']; //'parent_id',

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Patient')->withTimestamps();
    }

    public function stationary_harmfuls(): HasMany
    {
        return $this->hasMany("App\Models\StationaryHarmful");
    }
}
