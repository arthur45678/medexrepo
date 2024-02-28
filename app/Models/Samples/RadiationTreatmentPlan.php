<?php

namespace App\Models\Samples;

use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;

class RadiationTreatmentPlan extends Model
{

    protected $table = 'radiation_treatment_plans';
    protected $fillable = [
        'user_id','radiation_card_id','course_radical_program','course_amoqich','course_auxiliary','course_effective',
        'dosage_standart', 'dosage_mult','dosage_escal','dosage_large','dosage_comment','patient_position_on_the_back','patient_position_on_the_abdomen',
        'patient_position_comment','ktc1','	ktc2','ktc3','physic_doctor_id ','radiation_therapevt_doctor_id',
    ];


    /**
     * ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(RadiationTreatmentCard::class,'radiation_card_id', 'id');
    }


    public function physic_doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, "physic_doctor_id", "id");
    }

    public function radiation_therapevt_doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, "radiation_therapevt_doctor_id", "id");
    }


    /**
     * Relation to the attending_doctor (Բուժող բժիշկ)
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function storeData($request,$cart_id)
    {
        $fields = $request->only($this->fillable);
        $fields['radiation_card_id'] = $cart_id;
        $fields['user_id'] = Auth::user()->id;

        if($request->course_radical_program){
            $fields['course_radical_program'] = 1;
        }

        if($request->course_amoqich){
            $fields['course_amoqich'] = 1;
        }
        if($request->course_auxiliary){
            $fields['course_auxiliary'] = 1;
        }

        if($request->course_auxiliary){
            $fields['course_auxiliary'] = 1;
        }

        if($request->course_effective){
            $fields['course_effective'] = 1;
        }
        if($request->dosage_standart){
            $fields['dosage_standart'] = 1;
        }
        if($request->dosage_mult){
            $fields['dosage_mult'] = 1;
        }
        if($request->dosage_escal){
            $fields['dosage_escal'] = 1;
        }
        if($request->dosage_large){
            $fields['dosage_large'] = 1;
        }
        if($request->patient_position_on_the_back){
            $fields['patient_position_on_the_back'] = 1;
        }
        if($request->patient_position_on_the_abdomen){
            $fields['patient_position_on_the_abdomen'] = 1;
        }

        $item = $this->create($fields);
       return $item;
    }

    public function updateData($request)
    {
        $fields = $request->only($this->fillable);

        if($request->course_radical_program){
            $fields['course_radical_program'] = 1;
        }else{
            $fields['course_radical_program'] = null;
        }

        if($request->course_amoqich){
            $fields['course_amoqich'] = 1;
        }else{
            $fields['course_amoqich'] = null;
        }
        if($request->course_auxiliary){
            $fields['course_auxiliary'] = 1;
        }else{
            $fields['course_auxiliary'] = null;
        }

        if($request->course_auxiliary){
            $fields['course_auxiliary'] = 1;
        }else{
            $fields['course_auxiliary'] = null;
        }

        if($request->course_effective){
            $fields['course_effective'] = 1;
        }else{
            $fields['course_effective'] = null;
        }
        if($request->dosage_standart){
            $fields['dosage_standart'] = 1;
        }else{
            $fields['dosage_standart'] = null;
        }
        if($request->dosage_mult){
            $fields['dosage_mult'] = 1;
        }else{
            $fields['dosage_mult'] = null;
        }
        if($request->dosage_escal){
            $fields['dosage_escal'] = 1;
        }else{
            $fields['dosage_escal'] = null;
        }
        if($request->dosage_large){
            $fields['dosage_large'] = 1;
        }else{
            $fields['dosage_large'] = null;
        }
        if($request->patient_position_on_the_back){
            $fields['patient_position_on_the_back'] = 1;
        }else{
            $fields['patient_position_on_the_back'] = null;
        }
        if($request->patient_position_on_the_abdomen){
            $fields['patient_position_on_the_abdomen'] = 1;
        }else{
            $fields['patient_position_on_the_abdomen'] = null;
        }

        $item = $this->update($fields);
        return $item;
    }
}
