<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUserId;
use App\Traits\FormatsDateFields;
use Illuminate\Support\Facades\DB;

class RadiationTreatmentNotes extends Model
{
    protected $table = 'radiation_treatment_notes';
    protected $fillable = [
        'user_id','radiation_card_id','radiation_date','patient_position_comment','irradiated_area','field_dimensions',
        'radiation_intensity','mod','god','N_dd',
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

    public function storeData($request, $card_id)
    {
        $fields = $request->only($this->fillable);
        $fields['radiation_card_id'] = $card_id;
        $fields['user_id'] = Auth::user()->id;

        $item = $this->create($fields);
        return $item;
    }

    public function updateData($request)
    {
        $fields = $request->only($this->fillable);

        $item = $this->update($fields);
        return $item;
    }

}
