<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self ordinary()
 * @method static self pale()
 * @method static self cyanotic()
 * @method static self yellow()
 */
final class SkinCoveringsEnum extends Enum
{
    const MAP_VALUE = [
        'ordinary' => 'ordinary',
        'pale' => 'pale',
        'cyanotic' => 'cyanotic',
        'yellow' => 'yellow',
    ];
}
