<?php

namespace App\Models\Samples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Department;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class ExpressPaterrn extends Model implements ApprovableContract
{
    use LogsActivity, Approvable, FormatsDateFields;


    protected static $logName = 'express_paterrns';

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];



    protected $fillable = [
        'parent_id',
        'user_id',
        'patient_id',
        'department_id',
        'hospital_room_number',
        'attending_doctor_id',
        'historian',
        'dateTime',
        'hemoglobin',
        'erythrocytes',
        'leukocytes',
        'hematocrit',
        'ena',
        'glucose',
        'urine',
        'prothrombin',
        'bilirubin',
        'just',
        'indirect',
        'coagulation',
        'common_protein',
        'diastasis',
        'amylase',
        'color',
        'specific_weight',
        'protein',
        'ketone_bodies',
        'sediment',
        'urine_erythrocytes',
        'urine_leukocytes',
        'urine_epithelium',
        'urine_rollers',
        'urine_crystals',
        'urine_microorganisms',
        'urine_doctor',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function attending_doctor_name()
    {
        return $this->hasOne(User::class, "id", "attending_doctor_id");
    }
    public function departments()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
    public function user_doctor()
    {
        return $this->hasOne(User::class, "id", "urine_doctor");
    }

    public static function getParent($id,$data)
    {

        $arr_cat = [];
//        $cats = (array) DB::select('SELECT * FROM express_paterrns where `patient_id`=' .$id . 'AND `id`=' .$data);
        $cats = (array) DB::select("SELECT * FROM express_paterrns where `parent_id`=$data");


        foreach ($cats as $row) {
            $arr_cat[$row->id] = (array)$row;
        }
        return $arr_cat;
    }

    public static function mapTree($dataset)
    {

        $tree = array();
        foreach ($dataset as $id=>&$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        dd($tree);
        return $tree;
    }

}
