<?php

namespace App\Models\Samples;

use Illuminate\Database\Eloquent\Model;

class ExtractDiagnosisAndSurgical extends Model
{
    protected $fillable=[
        "type",
        "data",
        "comments",
        'parent_id',
    ];
}
