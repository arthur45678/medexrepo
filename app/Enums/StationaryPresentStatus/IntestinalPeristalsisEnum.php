<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self active()
 * @method static self weak()
 * @method static self absent()
 */
final class IntestinalPeristalsisEnum extends Enum
{
    const MAP_VALUE = [
        'active' => 'active',
        'weak' => 'weak',
        'absent' => 'absent',
    ];
}
