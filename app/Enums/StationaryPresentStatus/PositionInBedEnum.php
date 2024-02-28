<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self active()
 * @method static self passive()
 * @method static self forced()
 */
final class PositionInBedEnum extends Enum
{
    const MAP_VALUE = [
        'active' => 'active',
        'passive' => 'passive',
        'forced' => 'forced',
    ];
}
