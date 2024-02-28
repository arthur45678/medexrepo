<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;

class PatientMedicineHistory extends Model
{
    protected $fillable = [
        'user_id',
        'appointment_sheet_id',
        'prescription_id',
        'medicine_id',
        'drugs',
        'const',
    ];
}
