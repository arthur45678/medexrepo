<?php

namespace App\Enums\Samples;

use Spatie\Enum\Enum;

/**
 * @method static self concomitant_treatment()
 * @method static self currently_receiving_treatment()
 */
final class SampleTreatmentsEnum extends Enum
{
    const MAP_VALUE = [
        
        'currently_receiving_treatment' => 'currently_receiving_treatment',
        'concomitant_treatment' => 'concomitant_treatment',
    ];
}
