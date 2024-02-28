<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self special_treatment()
 * @method static self palliative()
 * @method static self symptomatic()
 */
final class TumorTreatmentEnum extends Enum
{
    const MAP_VALUE = [
        'special_treatment' => 'special_treatment',
        'palliative' => 'palliative',
        'symptomatic' => 'symptomatic',
    ];
}
