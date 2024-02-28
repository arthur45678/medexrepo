<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self throughTheNose()
 * @method static self throughTheMouth()
 * @method static self thoracic()
 * @method static self abdominal()
 */
final class BreathingTypeEnum extends Enum
{
    const MAP_VALUE = [
        'throughTheNose' => 'through_the_nose',
        'throughTheMouth' => 'through_the_mouth',
        'thoracic' => 'thoracic',
        'abdominal' => 'abdominal',
    ];
}
