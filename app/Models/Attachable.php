<?php

namespace App\Models;

use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Attachable extends Model
{
    use HasUserId, SoftDeletes;

    protected $fillable = ["user_id", "directory", "attachment_name", "attachment_comment"];

    protected $appends = ["full_path"];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getFullPathAttribute(): string
    {
        return Str::replaceFirst('public', 'storage', $this->attributes["directory"]) . '/' . $this->attributes["attachment_name"];
    }

    public function getFullPathOsAttribute(): string
    {
        $full_path = $this->getFullPathAttribute();
        $ds = DIRECTORY_SEPARATOR;
        return str_replace('/', $ds, $full_path);
    }

    public function getRealPathOsAttribute(): string
    {
        # open file in directory, copy path and get the same by code!
        # $s = 'C:\ospanel\OSPanel\domains\medexrepo\storage\app\public\patients\2\StationarySpecialNote\f_1604753688.txt';
        # $p = 'C:\ospanel\OSPanel\domains\medexrepo\public\storage\patients\2\StationarySpecialNote\f_1604753688.txt';

        $full_path_os = $this->getFullPathOsAttribute();
        $real_path_os = public_path() . $full_path_os;
        return $real_path_os;
    }

    public function getExtensionAttribute(): string
    {
        $attachment_name_arr = explode('.', $this->attachment_name);
        return end($attachment_name_arr);
    }
}
