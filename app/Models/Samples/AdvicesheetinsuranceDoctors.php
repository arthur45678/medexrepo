<?php

namespace App\Models\Samples;

use App\Enums\Samples\SampleDiagnosesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdvicesheetinsuranceDoctors extends Model
{
    protected $table = 'advicesheetinsurance_doctors';
    protected $fillable = ['advicesheetinshurans_id','attending_doctor_id','doctors_comment'];

    public function advice_sheet_insurances()
    {
        return $this->belongsTo(AdviceSheetInsurance::class,'advicesheetinshurans_id','id');
    }




}
