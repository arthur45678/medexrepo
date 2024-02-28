<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Traits\HasCacheableOptions;

class Bed extends Model
{
    use HasCacheableOptions;

    protected $fillable = ["number", "is_occupied", "chamber_id", "status"];

    protected $casts = [
        "is_occupied" => "boolean"
    ];

    protected static function getColumnsForOptions(): array
    {
        return ["id", "number", "is_occupied", "chamber_id"];
    }

    public function beds(): HasManyThrough
    {
        return $this->hasManyThrough("App\Models\Bed", "App\Models\Chamber");
    }

    public function chamber(): BelongsTo
    {
        return $this->belongsTo("App\Models\Chamber");
    }
}
