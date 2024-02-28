<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self intolerance()
 * @method static self allergy()
 */
final class StationaryMedicineSideEffectEnum extends Enum
{
    const MAP_VALUE = [
        'intolerance' => 'intolerance',
        'allergy' => 'allergy',
    ];
}
