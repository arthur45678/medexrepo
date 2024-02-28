<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Models\User;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class BixSterilizationLog extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'bixsterilizationlog';
    protected $fillable = ['user_id','bix_sterilisation_date','bix_send_date','bix_type','bix_surgery_date','surgery_table_preparation',
        'remarks','nurse_id','general_nurse_id'];

    public function nurse(): BelongsTo
    {
        return $this->belongsTo(User::class, "nurse_id", "id");
    }

    public function general_nurse(): BelongsTo
    {
        return $this->belongsTo(User::class, "general_nurse_id", "id");
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

}
