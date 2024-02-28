<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self stationary()
 * @method static self stationary_primary_examination()
 */
final class StationarySurgeryEnum extends Enum
{
    const MAP_VALUE = [
        'stationary' => 'stationary',
        'stationary_primary_examination' => 'stationary_primary_examination',
    ];
}
