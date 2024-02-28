<?php

namespace App\Models;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Tnm extends Model implements ApprovableContract
{
    use LogsActivity,HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'tnms';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'T',
        'N',
        'M',

        "Grade",
        "L",
        "V",
        "pycmr",

        'user_id',
        'tnmable_id',
        'tnmable_type'
    ];

    public function tnmables() {
        return $this->morphTo(); // morphTo = morphMany + morphOne
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    // <em>T - (0,1,2,3,4)</em>
    public static function tCollection():array
    {
        return [
            ['id' => '0_a','name' => '0 a'],
            ['id' => '1_a','name' => '1 a'],
            ['id' => '2_a','name' => '2 a'],
            ['id' => '3_a','name' => '3 a'],
            ['id' => '4_a','name' => '4 a'],
            ['id' => 'is_a','name' => 'is a'],

            ['id' => '0_b','name' => '0 b'],
            ['id' => '1_b','name' => '1 b'],
            ['id' => '2_b','name' => '2 b'],
            ['id' => '3_b','name' => '3 b'],
            ['id' => '4_b','name' => '4 b'],
            ['id' => 'is_b','name' => 'is b'],
        ];
    }

    public static function tCollectionJson():string
    {
        return json_encode(self::tCollection());
    }


    // <em>N - (0,1,2,3,x)</em>
    public static function nCollection():array
    {
        return [
            ['id' => '0_a','name' => '0 a'],
            ['id' => '1_a','name' => '1 a'],
            ['id' => '2_a','name' => '2 a'],
            ['id' => '3_a','name' => '3 a'],
            ['id' => 'x_a','name' => 'x a'],

            ['id' => '0_b','name' => '0 b'],
            ['id' => '1_b','name' => '1 b'],
            ['id' => '2_b','name' => '2 b'],
            ['id' => '3_b','name' => '3 b'],
            ['id' => 'x_b','name' => 'x b'],
        ];
    }

    public static function nCollectionJson():string
    {
        return json_encode(self::nCollection());
    }


    // <em>M - (0,1,x)</em>
    public static function mCollection():array
    {
        return [
            ['id' => '0_a','name' => '0 a'],
            ['id' => '1_a','name' => '1 a'],
            ['id' => 'x_a','name' => 'x a'],

            ['id' => '0_b','name' => '0 b'],
            ['id' => '1_b','name' => '1 b'],
            ['id' => 'x_b','name' => 'x b'],
        ];
    }

    public static function mCollectionJson():string
    {
        return json_encode(self::mCollection());
    }


    // <em>Grade - (x, 1, 2, 3, 4)</em>
    public static function gradeCollection():array
    {
        return [
            ['id' => '1','name' => '1'],
            ['id' => '2','name' => '2'],
            ['id' => '3','name' => '3'],
            ['id' => '4','name' => '4'],
            ['id' => 'x','name' => 'x'],

            // ['id' => '1_a','name' => '1 a'],
            // ['id' => '2_a','name' => '2 a'],
            // ['id' => '3_a','name' => '3 a'],
            // ['id' => '4_a','name' => '4 a'],
            // ['id' => 'x_a','name' => 'x a'],

            // ['id' => '1_b','name' => '1 b'],
            // ['id' => '2_b','name' => '2 b'],
            // ['id' => '3_b','name' => '3 b'],
            // ['id' => '4_b','name' => '4 b'],
            // ['id' => 'x_b','name' => 'x b'],
        ];
    }

    public static function gradeCollectionJson():string
    {
        return json_encode(self::gradeCollection());
    }


    // <em>L - (0,1,x)</em>
    public static function lCollection():array
    {
        return [
            ['id' => '0','name' => '0'],
            ['id' => '1','name' => '1'],
            ['id' => 'x','name' => 'x'],

            // ['id' => '0_a','name' => '0 a'],
            // ['id' => '1_a','name' => '1 a'],
            // ['id' => 'x_a','name' => 'x a'],

            // ['id' => '0_b','name' => '0 b'],
            // ['id' => '1_b','name' => '1 b'],
            // ['id' => 'x_b','name' => 'x b'],
        ];
    }

    public static function lCollectionJson():string
    {
        return json_encode(self::lCollection());
    }


    // <em>V - (0,1,2,x)</em>
    public static function vCollection():array
    {
        return [
            ['id' => '0','name' => '0'],
            ['id' => '1','name' => '1'],
            ['id' => '2','name' => '2'],
            ['id' => 'x','name' => 'x'],

            // ['id' => '0_a','name' => '0 a'],
            // ['id' => '1_a','name' => '1 a'],
            // ['id' => '2_a','name' => '2 a'],
            // ['id' => 'x_a','name' => 'x a'],

            // ['id' => '0_b','name' => '0 b'],
            // ['id' => '1_b','name' => '1 b'],
            // ['id' => '2_b','name' => '2 b'],
            // ['id' => 'x_b','name' => 'x b'],
        ];
    }

    public static function vCollectionJson():string
    {
        return json_encode(self::vCollection());
    }


        // <em>V - (0,1,2,x)</em>
        public static function pycmrCollection():array
        {
            return [
                ['id' => 'p','name' => 'p'],
                ['id' => 'y','name' => 'y'],
                ['id' => 'c','name' => 'c'],
                ['id' => 'm','name' => 'm'],
                ['id' => 'r','name' => 'r'],
            ];
        }

        public static function pycmrCollectionJson():string
        {
            return json_encode(self::pycmrCollection());
        }

}
