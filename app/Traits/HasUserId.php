<?php

namespace App\Traits;

use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserId
{
    protected static $userIdColumnName = "user_id";

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model): void {
            if (empty($model->attributes[static::$userIdColumnName]) || !isset($model->attributes[static::$userIdColumnName]))
                $model->attributes[static::$userIdColumnName] = Auth::id() ?? 1;
        });
    }

    /**
     * Relation to the user A.K.A. doctor (Բժիշկ, հիմնականում լրացնող, HasUserId trait)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", static::$userIdColumnName, "id");
    }
}
