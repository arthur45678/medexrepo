<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TreatmentList extends Model
{
    use HasCacheableOptions;

    protected $fillable = [
        'name','status'
    ];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function stationary_treatments(): HasMany
    {
        return $this->hasMany("App\Models\StationaryTreatment", "treatment_id", "id");
    }


    // Մուտքի օռդեռ
    public function order()
    {
        return  $this->belongsToMany(Order::class,'order_treatment','treatment_id','order_id');
    }
}
