<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self easy()
 * @method static self difficult()
 * @method static self painful()
 * @method static self frequent()
 */
final class UrinationTypeEnum extends Enum
{
    const MAP_VALUE = [
        'easy' => 'easy',
        'difficult' => 'difficult',
        'painful' => 'painful',
        'frequent' => 'frequent',
    ];
}
