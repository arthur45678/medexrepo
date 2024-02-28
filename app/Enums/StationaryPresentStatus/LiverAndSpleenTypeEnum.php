<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self soft()
 * @method static self solid()
 * @method static self swollen()
 */
final class LiverAndSpleenTypeEnum extends Enum
{
    const MAP_VALUE = [
        'soft' => 'soft',
        'solid' => 'solid',
        'swollen' => 'swollen',
    ];
}
