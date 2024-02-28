<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self negative()
 * @method static self weakPositive()
 * @method static self strictPositive()
 */
final class AbdominalUrinarySymptomEnum extends Enum
{
    const MAP_VALUE = [
        'negative' => 'negative',
        'weakPositive' => 'weak_positive',
        'strictPositive' => 'strict_positive',
    ];
}
