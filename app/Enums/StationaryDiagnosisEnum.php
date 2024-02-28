<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self primary_disease()
 * @method static self admission()
 * @method static self referring_institution()
 * @method static self clinical()
 * @method static self final_clinical()
 * @method static self disease_complication()
 * @method static self concomitant_disease()
 * @method static self tuberculosis_complaint()
 * @method static self previous_disease()
 * @method static self stationary_present_status_preliminary()
 */
final class StationaryDiagnosisEnum extends Enum
{
    const MAP_VALUE = [
        'primary_disease' => 'primary_disease',
        'admission' => 'admission',
        'referring_institution' => 'referring_institution',
        'clinical' => 'clinical',
        'final_clinical' => 'final_clinical',
        'disease_complication' => 'disease_complication',
        'concomitant_disease' => 'concomitant_disease',
        'tuberculosis_complaint' => 'tuberculosis_complaint',
        'previous_disease' => 'previous_disease',
        'stationary_present_status_preliminary' => 'stationary_present_status_preliminary',

    ];
}
