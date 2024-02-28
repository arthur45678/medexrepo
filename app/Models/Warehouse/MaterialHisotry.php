<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class MaterialHisotry extends Model
{
    protected $fillable = [
        'DocumentNumber',
        'Comment',
        'StorageExpense',
        'Chief',
    ];
}
