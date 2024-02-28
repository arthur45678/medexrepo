<?php

namespace App\Models\Pharmacy;

use App\Models\MeasurementUnit;
use App\Models\MedicineList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PharmacyModel extends Model
{
    use LogsActivity;

    protected static $logName = 'pharmacy_models';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'medicine_id',
        'medicine_code',
        'unit_of_measurement',
        'department_id',
        'department_code',
        'act',
        'comment',
        'price',
        'balance_of_the_month',
        'enter',
        'cost',
        'balance_end_math_count',
    ];
    public function ScopeDateAndMath($query){
        $start_math=Carbon::now()->startOfMonth()->toDateString();
        $end_math=Carbon::now()->endOfMonth()->toDateString();


        $query->whereBetween('created_at', [$start_math, $end_math]);
    }
    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
    public function MeasurementUnit()
    {
        return $this->hasOne(MeasurementUnit::class, "id", "unit_of_measurement");
    }

}
