<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\StationarySurgeryEnum;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;

class StationarySurgery extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, FormatsDateFields, Approvable;

    protected static $logName = 'stationary_surgery';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = ["type", "surgery_id", "complications", "surgery_date", "anesthesia_id", "stationary_id", "user_id"];

    protected $enums = [
        "type" => StationarySurgeryEnum::class,
    ];

    public function getTypeValueAttribute(): string // Get Value from the Spatie/LaravelEnum Class
    {
        return $this->type->getValue();
    }

    public function anesthesia(): BelongsTo
    {
        return $this->belongsTo("App\Models\AnesthesiaList", "anesthesia_id", "id");
    }

    public function surgery(): BelongsTo
    {
        return $this->belongsTo("App\Models\SurgeryList", "surgery_id", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
