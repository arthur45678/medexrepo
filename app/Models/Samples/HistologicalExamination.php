<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Traits\Approvable;
use App\Models\User;
use Illuminate\Http\Request;

use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;


class HistologicalExamination extends Model implements ApprovableContract
{
    protected $table = 'histological_examinations';
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected $fillable = ['user_id','patient_id','attending_doctor_id','admission_date','department_id',
        'stationary_id','ambulator_id','biopsy','biopsy_dubble','biopsy_dubble_date','surgery_id','surgery_date',
        'substance_quantity','sample_quantity','examination_date','biopsy_diagnostic','biopsy_fast','surgery_material',
        'painting_method','macro_and_micro_description','diagnosis_date','pathologist_doctor_id'];
    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }

    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function pathologist_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    public function sample_diagnoses(): MorphMany
    {
        return $this->morphMany(SampleDiagnose::class, 'diagnosable');
    }

    //Կլնիկական ախտորոշում
    public function storeClinicalDiagnoses($request)
    {
        $clinical_diagnosis = array_slice($request->clinical_diagnosis, 0, $request->clinical_diagnosis_length);
        if (count(array_filter($clinical_diagnosis))) {

            foreach ($clinical_diagnosis as $key => $item) {
                if ($item) {
                   $res = SampleDiagnose::create([
                        'card_id' => $this->id,
                        'user_id' => auth()->user()->id,
                        'diagnosis_comment' => $request->clinical_diagnosis_comment[$key],
                        'patient_id' => $this->patient->id,
                        'diagnosable_type' => SampleDiagnosesEnum::histological_clinical_diagnosis(),
                        'disease_id' => $item,
                    ]);
                }
            }
        }
        return $this;
    }


    //Հյուսվածքաբանական եզրակացություն (ախտորոշում)
    public function storeHistologicalSummaryDiagnosis($request)
    {
        $histology_summary_diagnosis = array_slice($request->histology_summary_diagnosis, 0, $request->histology_summary_diagnosis_length);
        if (count(array_filter($histology_summary_diagnosis))) {

            foreach ($histology_summary_diagnosis as $key => $item) {
                if ($item) {
                    SampleDiagnose::create([
                        'card_id' => $this->id,
                        'user_id' => auth()->user()->id,
                        'diagnosis_comment' => $request->histology_summary_diagnosis_comment[$key],
                        'patient_id' => $this->patient->id,
                        'diagnosable_type' => SampleDiagnosesEnum::histological_summary_diagnosis(),
                        'disease_id' => $item,
                    ]);
                }
            }
        }
        return $this;
    }

}
