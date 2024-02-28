<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class StationarySurgeryProtocol extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, FormatsDateFields, Approvable;

    protected static $logName = 'stationary_surgery_protocol';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        "user_id",
        "anesthesiologist_id",
        "anesthesiology_doctor_id",
        "stationary_id",

        "date",
        "surgery_id",
        "surgery_name",
        "surgery_start",
        "surgery_end",

        "anesthesia_id",
        "medicine_id",
        "anesthesia_process"
    ];

    /**
     * Relation to the anesthesiologist (Անեսթեզիստ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anesthesiologist(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "anesthesiologist_id", "id");
    }

    /**
     * Relation to the anesthsiology_doctor (Անզգայացման բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anesthsiology_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "anesthsiology_doctor_id", "id");
    }

    /**
     * Relation to the medicine_item (Անզգայացման Դեղանիջոց - MedicineList)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine_item(): BelongsTo
    {
        return $this->belongsTo("App\Models\MedicineList", "medicine_id", "id");
    }

    /**
     * Relation to the surgery (SurgeryList)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surgery(): BelongsTo
    {
        return $this->belongsTo("App\Models\SurgeryList", "surgery_id", "id");
    }

    /**
     * Relation to the anesthesia (AnesthesiaList)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anesthesia(): BelongsTo
    {
        return $this->belongsTo("App\Models\AnesthesiaList", "anesthesia_id", "id");
    }

    /**
     * Relation to the stationary card
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stationary(): BelongsTo
    {
        return $this->belongsTo("App\Models\Stationary");
    }
}
