<?php

namespace App\Models\Samples;

use App\Enums\StationaryDiagnosisEnum;
use App\Models\SurgeryList;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
use App\Models\Diagnosis;
use App\Models\Stationary;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;

class AnesthesiologistPreSurgeryExamination extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'anesthesiology_presurgery_examination';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id',
        'patient_id',
        'attending_doctor_id',
        'date',
        'body_structure',
        'weight',
        'complaints',
        'surgery_type',
        'consciousness',
        'the_skin',
        'cardiovascular_system',
        'heart_contraction',
        'auscultation',
        'veins',
        'respiratory_system',
        'oral',
        'mallampati',
        'other_organ_systems',
        'laboratory_tests',
        'allergic',
        'surgical',
        'special_notes',
        'ASA',
        'anesthesia_id',
        'patient_guardian_relative',
        'surgery_datetime',
        'surgery_id',
        'surgeries_comment',

    ];


    /**
     * Relation to the patient
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }
    public function surgerylists(): HasOne
    {
        return $this->hasOne(SurgeryList::class,'id','surgery_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
//    public function sample_diagnoses(): MorphMany
//    {
//        return $this->morphMany(SampleDiagnose::class, 'diagnosable');
//    }
//
//    public function sample_treatments()
//    {
//        return $this->morphMany(SampleTreatments::class, 'treatable');
//    }
//
//    public function sample_surgeries()
//    {
//        return $this->morphMany(SampleSurgeries::class, 'surgeryable');
//    }
}
