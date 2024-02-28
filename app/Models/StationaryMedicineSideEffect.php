<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\StationaryMedicineSideEffectEnum;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;

class StationaryMedicineSideEffect extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, HasEnums, Approvable;

    protected static $logName = 'stationary_medicine_side_effect';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["type", "user_id", "stationary_id", "medicine_id", "medicine_comment"];

    protected $enums = [
        "type" => StationaryMedicineSideEffectEnum::class,
    ];

    public function getTypeValueAttribute(): string
    {
        return $this->type->getValue();
    }

    /**
     * Get the user who owns the medicine_side_effect.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the medicine(name, code) for the medicine_side_effect.
     */
    public function medicine_item(): BelongsTo
    {
        return $this->belongsTo('App\Models\MedicineList', "medicine_id", "id");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
