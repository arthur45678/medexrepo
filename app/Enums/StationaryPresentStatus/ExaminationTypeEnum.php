<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self laboratoryTestsOfBloodAndUrine()
 * @method static self electrocardiography()
 * @method static self xRayOfTheChestOrgans()
 */
final class ExaminationTypeEnum extends Enum
{
    const MAP_VALUE = [
        'laboratoryTestsOfBloodAndUrine' => 'laboratory_tests_of_blood_and_urine',
        'electrocardiography' => 'electrocardiography',
        'xRayOfTheChestOrgans' => 'X_ray_of_the_chest_organs',
    ];
}
