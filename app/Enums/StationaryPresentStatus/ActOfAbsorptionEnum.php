<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self free()
 * @method static self painful()
 * @method static self difficulty()
 */
final class ActOfAbsorptionEnum extends Enum
{
    const MAP_VALUE = [
        'free' => 'free',
        'painful' => 'painful',
        'difficulty' => 'difficulty',
    ];
}
