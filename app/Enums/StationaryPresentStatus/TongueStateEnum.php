<?php

namespace App\Enums\StationaryPresentStatus;

use Spatie\Enum\Enum;

/**
 * @method static self wet()
 * @method static self dry()
 * @method static self glorified()
 * @method static self ulcers()
 * @method static self aphthae()
 */
final class TongueStateEnum extends Enum
{
    const MAP_VALUE = [
        'wet' => 'wet',
        'dry' => 'dry',
        'glorified' => 'glorified',
        'ulcers' => 'ulcers',
        'aphthae' => 'aphthae',
    ];
}
