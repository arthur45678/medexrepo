<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeStaff extends Model
{
    protected $table = 'administrative_staff';
    protected $fillable = ['title','type'];

    public function departments()
    {
        return $this->belongsToMany(Department::class,'administrative_departments','administrative_id','department_id');
    }
}
