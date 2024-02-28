<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Approvement extends Model
{
    protected $fillable = ["approvable_id", "approvable_type", "status", "department_id", "approved_by"];

    /**
     * Check if the model or changes to it are approved
     *
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->status;
    }

    /**
     * Relation to the approvable model
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function approvable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation to the department of the doctor(user) who has written the approvable
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo("App\Models\Department");
    }

    /**
     * Relation to the user, who has approved the change
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "approved_by", "id");
    }
}
