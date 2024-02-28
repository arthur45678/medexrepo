<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Traits\HasCacheableOptions;

class Department extends Model
{
    use HasCacheableOptions;

    protected $fillable = ["name", "has_bads", 'code',"closed", "closed_from_inside", "closed_from_outside"];

    protected static function getColumnsForOptions(): array
    {
        return ["id as value", "name as label"];
    }

    public function stationary(): HasMany
    {
        return $this->hasMany("App\Models\Stationary");
    }

    public function chambers(): HasMany
    {
        return $this->hasMany("App\Models\Chamber");
    }

    // department's workers
    public function users(): HasMany
    {
        return $this->hasMany("App\Models\User");
    }

    // patients, sent to department
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Patient', 'patient_connections', 'department_id', 'patient_id')->withTimestamps();
    }

    // department bulletins
    public function department_work_time_bulletins(): HasMany
    {
        return $this->hasMany('App\Models\OtherSamples\DepartmentWorkTimeBulletin');
    }


    // Admin storeDepartment
    public static function storeDepartment($requestData)
    {
        $data = [];
        $data['name'] = $requestData['name'];
        isset($requestData['has_bads']) ? $data['has_bads'] = 1 :  $data['has_bads'] = 0;
        isset($requestData['closed_from_inside']) ? $data['closed_from_inside'] = 1 :  $data['closed_from_inside'] = 0;
        isset($requestData['closed_from_outside']) ? $data['closed_from_outside'] = 1 :  $data['closed_from_outside'] = 0;
        return self::create($data);
    }

    // Admin updateDepartment
    public static function updateDepartment($requestData, $id)
    {
        $data = [];
        $data['name'] = $requestData['name'];
        isset($requestData['has_bads']) ? $data['has_bads'] = 1 :  $data['has_bads'] = 0;
        isset($requestData['closed_from_inside']) ? $data['closed_from_inside'] = 1 :  $data['closed_from_inside'] = 0;
        isset($requestData['closed_from_outside']) ? $data['closed_from_outside'] = 1 :  $data['closed_from_outside'] = 0;

        $item = self::findOrFail($id);
        return $item->update($data);
    }

    // մուտքի օրդեր
    public function order()
    {
        return $this->belongsToMany(Order::class,'order_department','department_id','order_id');
    }

    public function beds()
    {
        return $this->hasManyThrough("App\Models\Bed", "App\Models\Chamber");
    }


    public function administrativeStaff()
    {
        return $this->belongsToMany(AdministrativeStaff::class,'administrative_departments','department_id','administrative_id');
    }
}
