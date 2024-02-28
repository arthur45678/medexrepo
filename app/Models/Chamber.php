<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasCacheableOptions;

class Chamber extends Model
{
    use HasCacheableOptions;

    protected $fillable = ["number", "department_id", "status"];

    protected static function getColumnsForOptions(): array
    {
        return ["id", "number", "department_id"];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\Models\Department");
    }

    public function beds(): HasMany
    {
        return $this->hasMany("App\Models\Bed");
    }
}
