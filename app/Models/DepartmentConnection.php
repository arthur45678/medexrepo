<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DepartmentConnection extends Model
{
    protected $fillable = ["user_id", "department_id"];

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\Models\Department");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }
}
