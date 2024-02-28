<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Models\User;

use App\Enums\Samples\SampleDiagnosesEnum;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class AdviceSheetInsurance extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'advice_sheet_insurances';
    protected $fillable = ['user_id','patient_id','admission_date','complaints','research_done','Indications_for_surgery','volume_of_surgery','department_head_id','attending_doctor_id',/*'department_id'*/];

   // protected $guarded = [];
    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    // Տնօրեն
    public function department_head(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","department_head_id","id");
    }

    // Բուժող բժիշկ
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","attending_doctor_id","id");
    }

    public function sample_diagnoses()
    {
        return $this->morphMany(SampleDiagnose::class, 'diagnosable');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }

    public function adviceDoctors()
    {
        return $this->hasMany(AdvicesheetinsuranceDoctors::class,'advicesheetinshurans_id','id');
    }

    public function storeSampleDiagnosis(Request $request)
    {
        $sample_diagnoses = array_slice($request->sample_diagnoses, 0, $request->sample_diagnoses_length);
        if (count(array_filter($sample_diagnoses))) {
            foreach ($sample_diagnoses as $key => $referring) {
                if ($referring) {
                    SampleDiagnose::create([
                        'card_id' => $this->id,
                        'user_id' => auth()->user()->id,
                        'disease_id' => $referring,
                        'diagnosis_comment' => $request->sample_diagnoses_comment[$key],
                        'diagnosable_type' => SampleDiagnosesEnum::advice_sheet_inshurans_diagnosis(),
                        'patient_id' => $this->patient->id,
                    ]);
                }
            }
        }
    }

    public function storeDoctor(Request $request)
    {

        $sample_diagnoses = array_slice($request->advice_inshurans_sheet, 0, $request->advice_inshurans_sheet_doctors_length);


        if (count(array_filter($sample_diagnoses))) {
            foreach ($sample_diagnoses as $key => $referring) {
                if ($referring) {

                    self::create([
                        'card_id' => $this->id,
                        'user_id' => auth()->user()->id,
                        'disease_id' => $referring,
                        'diagnosis_comment' => $request->sample_diagnoses_comment[$key],
                        'diagnosable_type' => SampleDiagnosesEnum::advice_sheet_inshurans_diagnosis(),
                        'patient_id' => $this->patient->id,
                    ]);
                }
            }
        }
    }

}
