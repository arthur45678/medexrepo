<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self cachexia()
 * @method static self undeveloped()
 * @method static self normal()
 */
final class SubcutaneousFatEnum extends Enum
{
    const MAP_VALUE = [
        'cachexia' => 'cachexia',
        'undeveloped' => 'undeveloped',
        'normal' => 'normal',
    ];
}
