<?php

namespace App\Models\OtherSamples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AccountingForResearch extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'accounting_for_research';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'attending_doctor_id',

        'date',
        'action',
        'stationary_pp',
        'stationary_vj',
        'social_package',
        'stationary_sp',

        'ambulator_pp',
        'ambulator_internal',
        'ambulator_out',

        'social_package_internal',
        'social_package_out',

        'writing_sp_internal',
        'writing_sp_out',
    ];

    /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }


}
