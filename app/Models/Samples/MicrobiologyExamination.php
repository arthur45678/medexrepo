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

class MicrobiologyExamination extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected $table = 'microbiology_examinations';
    protected $fillable = ['user_id','patient_id','attending_doctor_id','medical_company_name',
        'susceptibility_to_antibiotics','susceptibility_to_antibiotics_date',
        'department_id','room','referred_doctor_id','agreement_number',
        'microbiology_examination','isolated_microflora','antibiotk_amoxiclav','amoxiclav_is_sensitive',
        'antibiotk_ciprofloxacin','ciprofloxacin_is_sensitive','antibiotk_azithromycin','azithromycin_is_sensitive','antibiotk_Carbenicillin',
        'Carbenicillin_is_sensitive','antibiotk_ampicillin','ampicillin_is_sensitive','antibiotk_Cefazolin','Cefazolin_is_sensitive',
        'antibiotk_Amoxicillin','Amoxicillin_is_sensitive','antibiotk_Cefotaxime','Cefotaxime_is_sensitive','antibiotk_Oxacillin',
        'Oxacillin_is_sensitive','antibiotk_Ceftazidime','Ceftazidime_is_sensitive','antibiotk_Gentamicin','Gentamicin_is_sensitive',
        'antibiotk_Cefuroxime','Cefuroxime_is_sensitive','antibiotk_Vancomycin','Vancomycin_is_sensitive','antibiotk_Ceftriaxone',
        'Ceftriaxone_is_sensitive','antibiotk_Imipenem','	Imipenem_is_sensitive','antibiotk_Moxifloxacin','Moxifloxacin_is_sensitive',
        'antibiotk_Penicillin','Penicillin_is_sensitive','antibiotk_Norfloxacin','Norfloxacin_is_sensitive','antibiotk_Metronidazole',
        'Metronidazole_is_sensitive','antibiotk_Cefoperazone','Cefoperazone_is_sensitive','antibiotk_Doxicillin','Doxicillin_is_sensitive',
        'antibiotk_Մետրոնիդազոլ','antibiotk_Metronidazole','Metronidazole_is_sensitive','antibiotk_furodonin','furodonin_is_sensitive','antibiotic_sensitive_date',
        ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo("App\Models\Patient");
    }


    //բուժող բժիշկ
    public function attending_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User");
    }

    //Ուղեգրող բժիշկ
    public function referred_doctor(): BelongsTo
    {
        return $this->belongsTo("App\Models\User","referred_doctor_id","id");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo("App\models\Department", "department_id", "id");
    }
}
