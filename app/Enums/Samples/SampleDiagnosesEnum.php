<?php

namespace App\Enums\Samples;

use Spatie\Enum\Enum;

/**
 * @method static self patomorph_disease()
 * @method static self chemotherapy_medicine()
 * @method static self concomitant_disease()
 * @method static self first_diagnosis()
 * @method static self suffering_diseases()
 * @method static self harmful_diseases()
 * @method static self histological_clinical_diagnosis()  //Հյուսվածքաբանական (բջջաբանական) հետազոտություն (Կլնիկական ախտորոշումը)
 * @method static self histological_summary_diagnosis()  // Հյուսվածքաբանական (բջջաբանական) հետազոտություն (Հյուսվածքաբանական եզրակացություն ախտորոշում)
 * @method static self advice_sheet_diagnosis()  // Խորհրդատվական թերթիկ ( ախտորոշում)
 * @method static self advice_sheet_inshurans_diagnosis()  // Խորհրդատվական ապահովագրական թերթիկ ( ախտորոշում)
*/

final class SampleDiagnosesEnum extends Enum
{
    const MAP_VALUE = [
        'harmful_diseases' => 'harmful_diseases',
        'first_diagnosis' => 'first_diagnosis',
        'suffering_diseases' => 'suffering_diseases',
        'concomitant_disease' => 'concomitant_disease',
        'patomorph_disease' => 'patomorph_disease',
        'chemotherapy_medicine' => 'chemotherapy_medicine',
        'histological_clinical_diagnosis' => 'histological_clinical_diagnosis',
        'histological_summary_diagnosis' => 'histological_summary_diagnosis',
        'advice_sheet_diagnosis' => 'advice_sheet_diagnosis',
        'advice_sheet_inshurans_diagnosis' => 'advice_sheet_inshurans_diagnosis',
    ];
}



