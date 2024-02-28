<?php

namespace App\Models\Samples;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RadiationTreatmentFinalData extends Model
{
    protected $table = 'radiation_treatment_final_data';
    protected $fillable = [
        'user_id','radiation_card_id','radio_reaction_no','radio_reaction_location','radio_reaction_hematologist','radio_reaction_general','radio_reaction_category','radio_reaction_comment',
        'radio_reaction_full_absorption','radio_reaction_small_50_procent','radio_reaction_high_50_procent','radio_reaction_without_result','radio_reaction_deepening',
        'ktc_1','ktc_2','ktc_3','mod_1','mod_2','mod_3','god_1','god_2','god_3','jdb_1','jdb_2','jdb_3','special_notes',
        'attending_doctor_id', 'department_head_doctor_id',

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

    public function storeData($request,$cart_id){
        $fields = $request->only($this->fillable);
        $fields['radiation_card_id'] = $cart_id;
        $fields['user_id'] = Auth::user()->id;

        if($request->radio_reaction_no){
            $fields['radio_reaction_no'] = 1;
        }
        if($request->radio_reaction_location){
            $fields['radio_reaction_location'] = 1;
        }
        if($request->radio_reaction_hematologist){
            $fields['radio_reaction_hematologist'] = 1;
        }
        if($request->radio_reaction_general){
            $fields['radio_reaction_general'] = 1;
        }
        if($request->radio_reaction_category){
            $fields['radio_reaction_category'] = 1;
        }
        if($request->radio_reaction_full_absorption){
            $fields['radio_reaction_full_absorption'] = 1;
        }
        if($request->radio_reaction_small_50_procent){
            $fields['radio_reaction_small_50_procent'] = 1;
        }
        if($request->radio_reaction_high_50_procent){
            $fields['radio_reaction_high_50_procent'] = 1;
        }
        if($request->radio_reaction_without_result){
            $fields['radio_reaction_without_result'] = 1;
        }
        if($request->radio_reaction_deepening){
            $fields['radio_reaction_deepening'] = 1;
        }
        $item = $this->create($fields);
        return $item;
    }

    public function updateData($request)
    {
        $fields = $request->only($this->fillable);

        if($request->radio_reaction_no){
            $fields['radio_reaction_no'] = 1;
        }else{
            $fields['radio_reaction_no'] = null;
        }
        if($request->radio_reaction_location){
            $fields['radio_reaction_location'] = 1;
        }else{
            $fields['radio_reaction_location'] = null;
        }
        if($request->radio_reaction_hematologist){
            $fields['radio_reaction_hematologist'] = 1;
        }else{
            $fields['radio_reaction_hematologist'] = null;
        }
        if($request->radio_reaction_general){
            $fields['radio_reaction_general'] = 1;
        }else{
            $fields['radio_reaction_general'] = null;
        }
        if($request->radio_reaction_category){
            $fields['radio_reaction_category'] = 1;
        }else{
            $fields['radio_reaction_category'] = null;
        }
        if($request->radio_reaction_full_absorption){
            $fields['radio_reaction_full_absorption'] = 1;
        }else{
            $fields['radio_reaction_full_absorption'] = null;
        }
        if($request->radio_reaction_small_50_procent){
            $fields['radio_reaction_small_50_procent'] = 1;
        }else{
            $fields['radio_reaction_small_50_procent'] = null;
        }
        if($request->radio_reaction_high_50_procent){
            $fields['radio_reaction_high_50_procent'] = 1;
        }else{
            $fields['radio_reaction_high_50_procent'] = null;
        }
        if($request->radio_reaction_without_result){
            $fields['radio_reaction_without_result'] = 1;
        }else{
            $fields['radio_reaction_without_result'] = null;
        }
        if($request->radio_reaction_deepening){
            $fields['radio_reaction_deepening'] = 1;
        }else{
            $fields['radio_reaction_deepening'] = null;
        }

        $item = $this->update($fields);
        return $item;
    }
}
