<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self neckArea()
 * @method static self thyroid()
 * @method static self leftBreast()
 * @method static self rightBreast()
 * @method static self abdominalCavity()
 * @method static self afterTheAbdominalCavity()
 * @method static self pelvicOrgans()
 */
final class UltrasoundableBodyPartEnum extends Enum
{
    const MAP_VALUE = [
        'neckArea' => 'neck_area',
        'thyroid' => 'thyroid',
        'leftBreast' => 'left_breast',
        'rightBreast' => 'right_breast',
        'abdominalCavity' => 'abdominal_cavity',
        'afterTheAbdominalCavity' => 'after_the_abdominal_cavity',
        'pelvicOrgans' => 'pelvic_organs',
    ];
}
