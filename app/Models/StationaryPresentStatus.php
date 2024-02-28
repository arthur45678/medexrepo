<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Enum\Laravel\HasEnums;

use App\Enums\StationaryPresentStatus\PositionInBedEnum;
use App\Enums\StationaryPresentStatus\SkinCoveringsEnum;
use App\Enums\StationaryPresentStatus\SubcutaneousFatEnum;
use App\Enums\StationaryPresentStatus\BreathingTypeEnum;
use App\Enums\StationaryPresentStatus\TongueStateEnum;
use App\Enums\StationaryPresentStatus\ActOfAbsorptionEnum;

use App\Enums\StationaryPresentStatus\AbdominalUrinarySymptomEnum;
use App\Enums\StationaryPresentStatus\LiverAndSpleenTypeEnum;
use App\Enums\StationaryPresentStatus\IntestinalPeristalsisEnum;
use App\Enums\StationaryPresentStatus\UrinationTypeEnum;
use App\Traits\Approvable;
use App\Traits\HasUserId;

class StationaryPresentStatus extends Model implements ApprovableContract
{
    use LogsActivity, HasEnums, HasUserId, Approvable;

    protected static $logName = 'stationary_present_status';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected  $fillable = [
        'stationary_id',
        'user_id',

        'patient_general_condition',
        'by_karnowski_scale',
        'consciousness',
        'position_in_bed',

        'skin_coverings',
        'subcutaneous_fat',
        'obesity',
        'varicose_of_lower_extremities',
        'varicose_of_lower_extremities_comment',
        'peripheral_edema',
        'peripheral_edema_comment',

        'lymph_node',
        'propulsion_system',
        'nervous_system',
        'breasts',

        'respiratory_complaints',
        'breathing_type',
        'lung_collision',
        'listening_breathing',
        'respiratory_movements_frequency_per_minute',

        'cardiovascular_complaints',
        'heart_percutaneous_border',
        'heartbeat',
        'vascular_stroke',
        // 'blood_pressure',

        'blood_pressure_systolic',
        'blood_pressure_diastolic',

        'endocrine_system',

        'lor_organs',

        'digestive_complaints',
        'tongue_state',
        'act_of_absorption',
        'absorption_difficulty_degree',

        'abdomen_is_symmetrical',
        'abdomen_is_involved_in_breathing',
        'pain_when_touching_abdomen_comment',

        // 5-th page
        'abdominal_urinary_symptom',
        'abdominal_urinary_symptom_comment',
        'liver_is_enlarged',
        'liver_size',
        'liver_type',
        'spleen_is_enlarged',
        'spleen_size',
        'spleen_type',
        'intestinal_peristalsis',

        'urogenital_complaints',
        'urination_type',
        'symptom_of_urogenital_collision',
        'symptom_of_urogenital_collision_comment',

        'status_localis',

        // StationaryDiagnosis::stationary_present_status_preliminary()
        'present_status_preliminary_disease_id',
        'present_status_preliminary_diagnosis_type',
        'present_status_preliminary_diagnosis_comment',

        'examination_program', // json
    ];

    protected $enums = [
        "position_in_bed" => PositionInBedEnum::class . ':nullable',
        "skin_coverings" => SkinCoveringsEnum::class . ':nullable',
        "subcutaneous_fat" => SubcutaneousFatEnum::class . ':nullable',
        "breathing_type" => BreathingTypeEnum::class . ':nullable',
        "tongue_state" => TongueStateEnum::class . ':nullable',
        "act_of_absorption" => ActOfAbsorptionEnum::class . ':nullable',

        "abdominal_urinary_symptom" => AbdominalUrinarySymptomEnum::class . ':nullable',
        "liver_type" => LiverAndSpleenTypeEnum::class . ':nullable',
        "spleen_type" => LiverAndSpleenTypeEnum::class . ':nullable',
        "intestinal_peristalsis" => IntestinalPeristalsisEnum::class . ':nullable',
        "urination_type" => UrinationTypeEnum::class . ':nullable',
    ];

    const EXAMINATION_PROGRAM_DEFAULT_ARRAY = array(
        'not_ultrasoundable' => [null],
        'ultrasoundable' => [null],
        'other' => [null]
    );

    public function getExaminationProgramArrayAttribute()
    {
        return json_decode($this->examination_program, true) ?? self::EXAMINATION_PROGRAM_DEFAULT_ARRAY;
    }

    public function stationary(): BelongsTo
    {
        return $this->belongsTo('App\Models\Stationary');
    }
}
