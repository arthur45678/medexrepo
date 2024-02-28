<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self in_reception()
 * @method static self pregnant_up_to_28_weeks()
 * @method static self pregnant_after_28_weeks()
 * @method static self before_giving_birth()
 * @method static self after_giving_birth()
 */

final class StationaryDeathCircumstanceEnum extends Enum
{
    const MAP_VALUE = [
        'in_reception' => 'in_reception',
        'pregnant_up_to_28_weeks' => 'pregnant_up_to_28_weeks',
        'pregnant_after_28_weeks' => 'pregnant_after_28_weeks',
        'before_giving_birth' => 'before_giving_birth',
        'after_giving_birth' => 'after_giving_birth',
    ];
}
