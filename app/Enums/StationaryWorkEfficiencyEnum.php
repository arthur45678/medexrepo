<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self fully()
 * @method static self partial()
 * @method static self temporary_loss()
 * @method static self stable_loss()
 * @method static self other()
 */
final class StationaryWorkEfficiencyEnum extends Enum
{
    const MAP_VALUE = [
        'fully' => "fully",
        'partial' => "partial",
        'temporary_loss' => "temporary_loss",
        'stable_loss' => "stable_loss",
        'other' => "other",
    ];
}
