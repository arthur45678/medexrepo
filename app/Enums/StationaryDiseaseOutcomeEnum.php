<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self recovery()
 * @method static self without_change()
 * @method static self with_improvement()
 * @method static self death()
 */
final class StationaryDiseaseOutcomeEnum extends Enum
{
    const MAP_VALUE = [
        'recovery' => 'recovery',
        'without_change' => 'without_change',
        'with_improvement' => 'with_improvement',
        'death' => 'death',
    ];
}
