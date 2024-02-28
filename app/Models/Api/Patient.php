<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $table = 'api_patients';

    protected $fillable = [
        'f_name',
        'l_name',
        'phone',
        'email',
        'soc_card',
        'password',
        'c_password',
    ];
    protected $guarded = [];

    public function getFullNameAttribute() {
        return $this->f_name . ' ' . $this->l_name;
    }

    protected $appends = [
        'full_name'
    ];

    protected $visible = [
        'id',
        'email',
        'phone',
        'soc_card',
        'full_name'
    ];

    public function queue(): HasOne
    {
        return $this->hasOne('App\Models\Api\Queue');
    }
}
