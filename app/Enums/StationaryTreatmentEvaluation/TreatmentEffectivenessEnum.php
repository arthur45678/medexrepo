<?php

namespace App\Enums\StationaryTreatmentEvaluation;

use Spatie\Enum\Enum;

/**
 * @method static self fullRegression()
 * @method static self partialRegression()
 * @method static self stabilization()
 * @method static self progress()
 */
final class TreatmentEffectivenessEnum extends Enum
{
    const MAP_VALUE = [
        'fullRegression' => 'full_regression',
        'partialRegression' => 'partial_regression',
        'stabilization' => 'stabilization',
        'progress' => 'progress',
    ];
}
