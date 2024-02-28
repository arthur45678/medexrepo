<?php

namespace App\Models\Pharmacy;

use App\Models\Department;
use App\Models\MedicineList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PharmacyEnterHistory extends Model
{
    use LogsActivity;

    protected static $logName = 'pharmacy_enter_histories';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'medicine_id',
        'department_id',
        'enter',

    ];
    public function ScopeDateAndMath($query){
        $start_math=Carbon::now()->startOfMonth()->toDateString();
        $end_math=Carbon::now()->endOfMonth()->toDateString();

        $query->where(function($query) use ($start_math, $end_math) {
            return $query->whereBetween('created_at', [$start_math, $end_math])
                ->orWhereNull('created_at');
        });
    }
    public function ScopeOrder($query){
        $query->orderBy('id', 'DESC');
    }
    public function medicine_name()
    {
        return $this->hasOne(MedicineList::class, "id", "medicine_id");
    }
    public function departament_name()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
}
