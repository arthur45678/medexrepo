<?php

namespace App\Enums\StationaryTreatmentEvaluation;

use Spatie\Enum\Enum;

/**
 * @method static self percent100()
 * @method static self percent90()
 * @method static self percent80()
 * @method static self percent70()
 * @method static self percent60()
 * @method static self percent50()
 * @method static self percent40()
 * @method static self percent30()
 * @method static self percent20()
 * @method static self percent10()
 */
final class KarnofskyPerformanceScaleEnum extends Enum
{
    const MAP_VALUE = [
        'percent100' => 'percent_100',
        'percent90' => 'percent_90',
        'percent80' => 'percent_80',
        'percent70' => 'percent_70',
        'percent60' => 'percent_60',
        'percent50' => 'percent_50',
        'percent40' => 'percent_40',
        'percent30' => 'percent_30',
        'percent20' => 'percent_20',
        'percent10' => 'percent_10',
    ];
}
