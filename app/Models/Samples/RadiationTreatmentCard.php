<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;
use App\Enums\StationaryDiagnosisEnum;
use App\Models\Diagnosis;
use App\Models\DiseaseList;
use App\Models\Stationary;
use App\Models\Samples\SampleDiagnose;
use App\Models\User;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadiationTreatmentCard extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;
    protected static $logName = 'radiation_treatment_cards';

    protected $table = 'radiation_treatment_cards';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    public $fillable = [
        'user_id','patient_id','clinical_disease_id','clinical_diagnosis_comment','patomorph_disease_id','patomorph_diagnosis_comment','concomitant_disease_id','concomitant_diagnosis_comment',
        'previously_received_treatment','surgery_date','surgery_disease_id','surgery_diagnosis_comment','chemterapy_date',
        'chemterapy_comment','radiation_treatment_date','radiation_treatment_comment','radiated_areas','tumor_placement',
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
        return $this->belongsTo(User::class, "attending_doctor_id", "id");
    }

    public function treatment_plan(): HasOne
    {
        return $this->HasOne(RadiationTreatmentPlan::class,'radiation_card_id','id');
    }

    public function treatment_notes(): HasOne
    {
        return $this->HasOne(RadiationTreatmentNotes::class,'radiation_card_id','id');
    }

    public function treatment_final_data(): HasOne
    {
        return $this->hasOne(RadiationTreatmentFinalData::class,'radiation_card_id','id');
    }

    public function clinical_disease()
    {
        return $this->belongsTo(DiseaseList::class, "clinical_disease_id","id");
    }

    public function patomorph_disease()
    {
        return $this->belongsTo(DiseaseList::class, "patomorph_disease_id","id");
    }

    public function surgery_disease()
    {
        return $this->belongsTo(DiseaseList::class, "surgery_disease_id","id");
    }



    public function updateData($request, $id)
    {
        $item = self::findOrFail($id);
        $fields = $request->only($this->fillable);
        $fields['radiation_reaction_no'] = $request->has('radiation_reaction_no');
        $fields['user_id'] = Auth::user()->id;
        if (isset($request->radiation_reaction_local)) {
            $fields['radiation_reaction_local'] = 1;
        }
        if (isset($request->radiation_reaction_hemolog)) {
            $fields['radiation_reaction_hemolog'] = 1;
        }
        if (isset($request->radiation_reaction_basic)) {
            $fields['radiation_reaction_basic'] = 1;
        }
        if (isset($request->radiation_reaction_level)) {
            $fields['radiation_reaction_level'] = 1;
        }
        if (isset($request->radiation_reaction)) {
            $fields['radiation_reaction'] = 1;
        }
        if (isset($request->treatment_result_full_absorption)) {
            $fields['treatment_result_full_absorption'] = 1;
        }
        if (isset($request->treatment_result_high_50_procent)) {
            $fields['treatment_result_high_50_procent'] = 1;
        }

        if (isset($request->treatment_result_low_50_procent)) {
            $fields['treatment_result_low_50_procent'] = 1;
        }
        if (isset($request->treatment_result_no_result)) {
            $fields['treatment_result_no_result'] = 1;
        }
        if (isset($request->treatment_result_deepening)) {
            $fields['treatment_result_deepening'] = 1;
        }

        $item->fill($fields);
        $item->save();
        return $item;
    }

    public function storeData($request, $patient_id)
    {
        $fields = $request->only($this->fillable);
        $this->fill($fields);
        $this->patient_id = $patient_id;
        $this->save();
        return $this;
    }



    public  function storeData__old($request, $patient_id)
    {
        // 6 Նախկինում ստատցած բուժումը
        if ($request->filled('radiation_treatment_at')) {
            $this->radiation_treatment_at = $request->radiation_treatment_at;
            $ch = $this->save();
        }

        //7․ ՈՒռուցքի տեղակայումը - (ՈՒԱԾ - տեղակայումը, ձևը, չափերը, խորությունը)
        $ch = null;
        if ($request->filled('swelling_place')) {
            $this->swelling_place = $request->swelling_place;
            $ch = $this->save();
        }


//8․ Կուրսը՝
        if ($request->filled('course_root')) {
            $this->swelling_place = $request->course_root;
            $ch = $this->save();
        }
        if ($request->filled('swelling_place')) {
            $this->swelling_place = $request->course_amoqich;
            $ch = $this->save();
        }
        if ($request->filled('course_ojandak')) {
            $this->course_ojandak = $request->course_ojandak;
            $ch = $this->save();
        }
        if ($request->filled('course_nerardyunavet')) {
            $this->course_nerardyunavet = $request->course_nerardyunavet;
            $ch = $this->save();
        }

        //9․ Դոզավորումը՝
        if ($request->filled('dosage_standart')) {
            $this->dosage_standart = $request->dosage_standart;
            $ch = $this->save();
        }
        if ($request->filled('dosage_mult')) {
            $this->dosage_mult = $request->dosage_mult;
            $ch = $this->save();
        }
        if ($request->filled('dosage_escal')) {
            $this->dosage_escal = $request->dosage_escal;
            $ch = $this->save();
        }
        if ($request->filled('dosage_big')) {
            $this->dosage_big = $request->dosage_big;
            $ch = $this->save();
        }
        if ($request->filled('dosage_description')) {
            $this->dosage_description = $request->dosage_description;
            $ch = $this->save();
        }

        //10․ Հիվանդի դիրքը
        if ($request->filled('pationt_position_on_the_back')) {
            $this->pationt_position_on_the_back = $request->pationt_position_on_the_back;
            $ch = $this->save();
        }
        if ($request->filled('pationt_position_on_the_abdomen')) {
            $this->pationt_position_on_the_abdomen = $request->pationt_position_on_the_abdomen;
            $ch = $this->save();
        }
        if ($request->filled('pationt_position_description')) {
            $this->pationt_position_description = $request->pationt_position_description;
            $ch = $this->save();
        }

        //11․ ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները,
        if ($request->filled('ctv_1')) {
            $this->ctv_1 = $request->ctv_1;
            $ch = $this->save();
        }
        if ($request->filled('ctv_2')) {
            $this->ctv_2 = $request->ctv_2;
            $ch = $this->save();
        }
        if ($request->filled('ctv_3')) {
            $this->ctv_3 = $request->ctv_3;
            $ch = $this->save();
        }

        //12․ Բժիշկ ֆիզիկոս


        //15․Ճառագայթահարման օրագիր
       /* if ($request->filled('radiation_therapy_date')) {
            $stationary->radiation_therapy_date = $request->radiation_therapy_date;
            $ch = $stationary->save();
        }*/
        //16.
        // $fields['radiation_reaction_no'] = $request->has('radiation_reaction_no');

        $this->radiation_reaction_no = $request->has('radiation_reaction_no');
        $this->radiation_reaction_local = $request->has('radiation_reaction_local');
        $this->radiation_reaction_hemolog = $request->has('radiation_reaction_hemolog');
        $this->radiation_reaction_basic = $request->has('radiation_reaction_basic');

        //  $this->radiation_reaction_level = $request->has('radiation_reaction_level');


        $this->radiation_reaction_level  = $request->has('radiation_reaction_level');
        if ($request->filled('radiation_reaction_level')) {
            $this->radiation_reaction_level = $request->radiation_reaction_level;
            $ch = $this->save();
        }



        //17․ Բուժման արդյունքը
        $this->treatment_result_full_absorption = $request->has('treatment_result_full_absorption');
        $this->treatment_result_high_50_procent = $request->has('treatment_result_high_50_procent');
        $this->treatment_result_low_50_procent = $request->has('treatment_result_low_50_procent');
        $this->treatment_result_no_result = $request->has('treatment_result_no_result');
        $this->treatment_result_deepening = $request->has('treatment_result_deepening');

        $ch = $this->save();
        //18. Եզրափակիչ տվյալներ


        if ($request->filled('final_result_ctv_1')) {
            $this->final_result_ctv_1 = $request->final_result_ctv_1;
            $ch = $this->save();
        }
        if ($request->filled('final_result_ctv_2')) {
            $this->final_result_ctv_2 = $request->final_result_ctv_2;
            $ch = $this->save();
        }
        if ($request->filled('final_result_ctv_3')) {
            $this->final_result_ctv_3 = $request->final_result_ctv_3;
            $ch = $this->save();
        }
        if ($request->filled('final_result_mod_1')) {
            $this->final_result_mod_1 = $request->final_result_mod_1;
            $ch = $this->save();
        }
        if ($request->filled('final_result_mod_2')) {
            $this->final_result_mod_2 = $request->final_result_mod_2;
            $ch = $this->save();
        }
        if ($request->filled('final_result_mod_3')) {
            $this->final_result_mod_3 = $request->final_result_mod_3;
            $ch = $this->save();
        }
        if ($request->filled('final_result_god_1')) {
            $this->final_result_god_1 = $request->final_result_god_1;
            $ch = $this->save();
        }
        if ($request->filled('final_result_god_2')) {
            $this->final_result_god_2 = $request->final_result_god_2;
            $ch = $this->save();
        }
        if ($request->filled('final_result_god_3')) {
            $this->final_result_god_3 = $request->final_result_god_3;
            $ch = $this->save();
        }
        if ($request->filled('final_result_jdb_1')) {
            $this->final_result_jdb_1 = $request->final_result_jdb_1;
            $ch = $this->save();
        }
        if ($request->filled('final_result_jdb_2')) {
            $this->final_result_jdb_2 = $request->final_result_jdb_2;
            $ch = $this->save();
        }
        if ($request->filled('final_result_jdb_3')) {
            $this->final_result_jdb_3 = $request->final_result_jdb_3;
            $ch = $this->save();
        }

        //19․ Հատուկ նշումներ՝
        if ($request->filled('special_notes')) {
            $this->special_notes = $request->special_notes;
            $ch = $this->save();
        }

        if ($request->filled('attending_doctor_id')) {
            $this->attending_doctor_id = $request->attending_doctor_id;
            $ch = $this->save();
        }
        if ($request->filled('department_head_doctor_id')) {
            $this->department_head_doctor_id = $request->department_head_doctor_id;
            $ch = $this->save();
        }

        if ($request->filled('anesthesiology_doctor_id')) {
            $this->anesthesiology_doctor_id = $request->anesthesiology_doctor_id;
            $ch = $this->save();
        }


        $fields = $request->only($this->fillable);
        $this->fill($fields);
        $this->patient_id = $patient_id;
        $this->save();
        return $this;
    }





}
