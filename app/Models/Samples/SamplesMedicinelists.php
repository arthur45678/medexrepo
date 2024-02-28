<?php

namespace App\Models\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleMedicinelistsEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
use App\Models\MedicineList;
use App\Models\Samples\RadiationTreatmentCard;
use App\Models\TreatmentList;
use App\Traits\Approvable;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;
use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SamplesMedicinelist extends Model implements ApprovableContract
{
    use HasUserId, LogsActivity, HasEnums, Approvable;
    protected $table = 'sample_medicinelists';
    protected $fillable = ['card_id','user_id','medicineLists_type','medicinelists_id','medicinelists_comment','medicinelists_date','drug_using_time'];

    protected $enums = [
        "medicineLists_type" => SampleMedicinelistsEnum::class,
    ];

    public function getMedicinelistsTypeValueAttribute(): string
    {
        return $this->medicineLists_type->getValue();
    }

    protected static $logName = 'sample_medicineLists';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];


    /**
     * Get the user who owns the diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the treatment(name, code) for the treatment.
     */
    public function medicine_item(): BelongsTo
    {
        return $this->belongsTo(MedicineList::class, "medicinelists_id", "id");
    }

    public static function getMedicines($card_id)
    {
        return self::where(['card_id' => $card_id, 'user_id' => Auth::user()->id,
            'treatments_type' => SampleMedicinelistsEnum::patients_management(),])->get();
    }

}
