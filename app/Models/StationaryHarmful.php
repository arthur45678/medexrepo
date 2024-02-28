<?php

namespace App\Models;

use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StationaryHarmful extends Model
{
    use HasUserId;

    protected $fillable = ["stationary_id", "user_id", "harmful_id", "harmful_comment"];

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }

    public function harmful(): BelongsTo
    {
        return $this->belongsTo("App\Models\Harmful");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }
}
