<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;


use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;


class HeatSheet extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'heat_sheets';
    protected $fillable = ['user_id','patient_id','department_id','attending_doctor_id','admission_date'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function heat_sheet_charts() : HasMany
    {
        return $this->hasMany(HeatSheetCharts::class,'heat_sheet_id','id');
    }

    public function storeHeathSheet($request, $patient_id)
    {
        $fields = $request->only($this->fields);
        $fields['patient_id'] = $patient_id;
        $item = self::create($fields);
        return $item;
    }
}
