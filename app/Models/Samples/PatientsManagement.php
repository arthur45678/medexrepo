<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleMedicinelistsEnum;
use App\Models\Patient;
use App\Traits\Approvable;
use App\Models\User;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;


class PatientsManagement extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'patients_management';

   protected $fillable = ['user_id','patient_id','attending_doctor_id','nurse_doctor_id','admission_date','mode_v','mode_v_comment','patient_v_cxp','patient_v_cxp_comment',
        'fq','fq_comment','patient_fq','patient_fq_comment','fiO2_peep','fiO2_peep_comment','ps_respiratory_assistance','ps_respiratory_assistance_comment',
        'in_the_airways_saO2','artery_pressure','artery_pressure_comment',
        'central_vein_pressure','central_vein_pressure_comment','pulse','pulse_comment','temperature','temperature_comment','dihurez','dihurez_comment',
        'drainages','drainages_comment','imported_liquid_ml','imported_liquid_ml_comment'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function nurse_doctor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




    public function storeData($request, $patient)
    {
        $data = $request->only($this->fillable);
        $data['patient_id'] = $patient->id;
        $data['user_id'] = Auth::user()->id;
        $this->fill($data);
        $this->save();
        return $this;
    }

    public static function getMedicineLists($card_id)
    {
        return SamplesMedicinelist::where(['card_id' => $card_id, 'user_id' => Auth::user()->id, 'medicineLists_type' => SampleMedicinelistsEnum::patients_management()])->get();
    }
}
