<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self year()
 * @method static self month()
 * @method static self day()
 */
final class StationaryAgeTypeEnum extends Enum
{
    const MAP_VALUE = [
        'year' => 'year',
        'month' => 'month',
        'day' => 'day',
    ];
}
