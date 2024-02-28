<?php

namespace App\Models\Warehouse;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class WarehouseModels extends Model
{
    protected $table = 'warehouse_models';
    protected $fillable = ["code", "quantity", "price","exit","department_id"];

    public function departament_name()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
    public function NMV()
    {
        return $this->hasOne(NamesMaterialValues::class, "code", "code");
    }
}
