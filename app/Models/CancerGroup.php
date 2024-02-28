<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CancerGroup extends Model
{
    public $timestamps = false;

    protected $fillable = ['regular_id', 'name'];

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Patient')->withTimestamps();
    }

    //     /**
    //  * Ուռուցքի, քաղցկեղի խումբ, նշվում է Ամբուլատոր քարտի առաձին էջում
    //  *
    //  * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function cancer_group_patient(): BelongsToMany
    // {
    //     return $this->belongsToMany('App\Models\Patient')->withTimestamps();
    // }
}
