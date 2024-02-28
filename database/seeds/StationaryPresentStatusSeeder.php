<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;
use App\Models\StationaryPresentStatus;

use App\Enums\StationaryPresentStatus\PositionInBedEnum;
use App\Enums\StationaryPresentStatus\SkinCoveringsEnum;
use App\Enums\StationaryPresentStatus\SubcutaneousFatEnum;
use App\Enums\StationaryPresentStatus\BreathingTypeEnum;
use App\Enums\StationaryPresentStatus\TongueStateEnum;
use App\Enums\StationaryPresentStatus\ActOfAbsorptionEnum;

use App\Enums\StationaryPresentStatus\AbdominalUrinarySymptomEnum;
use App\Enums\StationaryPresentStatus\LiverAndSpleenTypeEnum;
use App\Enums\StationaryPresentStatus\IntestinalPeristalsisEnum;
use App\Enums\StationaryPresentStatus\UrinationTypeEnum;

use App\Enums\StationaryDiagnosisEnum;

class StationaryPresentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();
        // $stationary = Stationary::all()->first();
        $stationary->stationary_present_status()->create([
            // 'stationary_id',
            'patient_general_condition' => 'Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա:',
            'by_karnowski_scale' => 'Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց:',
            'consciousness' => 'Ժամանակի ընթացքում ձևավորվել են koko-jambo-ի տարբեր վերսիաներ:',
            'position_in_bed' => PositionInBedEnum::active(),

            'skin_coverings' => SkinCoveringsEnum::pale(),
            'subcutaneous_fat' => SubcutaneousFatEnum::cachexia(),
            // 'obesity' => 40, // calculated value
            'varicose_of_lower_extremities' => false,
            'varicose_of_lower_extremities_comment' => 'երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն)',
            'peripheral_edema' => false,
            'peripheral_edema_comment' => 'Կան koko-ի շատ տարբերակներ, սակայն շատերը աղավաղվել են տարաբնույթ, երբեմն նույնիսկ լատիներենից շատ',

            'lymph_node' => 'Եթե ուզում եք օգտագործել koko-jambo, ապա երևի չեք ցանկանա, որ այն պարունակի ինչ-որ թաքնված հումոր տեքստի միջնամասում:',
            'propulsion_system' => 'Ինտերնետում բոլոր koko-jambo արտադրիչները հակված են կրկնել նույն տեքստը մինչև ցանկալի ծավալի լրացումը',
            'nervous_system' => 'Այն օգտագործում է լատիներենի շուրջ 200 բառ` դրանք համադրելով նախադասության հնարավոր շարադասությունների հետ',
            'breasts' => 'Արտադրված koko-jambo-ը, արդյունքում չունի կրկնություններ, հումորային բովանդակություն կամ այլ անիրական բառեր:',

            'respiratory_complaints' => 'Սկսած 1500-ականներից` koko-jambo-ը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ',
            'breathing_type' => BreathingTypeEnum::throughTheMouth(),
            'lung_collision' => 'տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է',
            'listening_breathing' => 'ինչը մի անհայտ տպագրիչի կողմից տարբեր տառատեսակների օրինակների գիրք ստեղծելու ջանքերի արդյունք է',
            'respiratory_movements_frequency_per_minute' => 'Այս տեքստը ոչ միայն կարողացել է գոյատևել հինգ դարաշրջան',

            'cardiovascular_complaints' => 'այլև ներառվել է էլեկտրոնային տպագրության մեջ` մնալով էապես անփոփոխ',
            'heart_percutaneous_border' => 'Այն հայտնի է դարձել 1960-ականներին koko-jambo բովանդակող',
            'heartbeat' => 'էջերի թողարկման արդյունքում, իսկ ավելի ուշ համակարգչային տպագրության այնպիսի',
            'vascular_stroke' => 'ծրագրերի թողարկման հետևանքով,',

            // 'blood_pressure' => 120,
            'blood_pressure_systolic' => 120,
            'blood_pressure_diastolic' => 120,

            'endocrine_system' => 'Հակառակ ընդհանուր պատկերացմանը` koko-jambo-ը այդքան էլ պատահական հավաքված տեքստ չէ:',

            'lor_organs' => 'Այս տեքստի արմատները հասնում են Ք.ա. 45թ. դասական լատինական գրականություն.',

            'digestive_complaints' => 'Ռիչարդ ՄքՔլինտոքը` Վիրջինիայի Համպդեն-Սիդնեյ քոլեջում լատիներենի մի դասախոս` ուսումնասիրելով',
            'tongue_state' => TongueStateEnum::dry(),
            'act_of_absorption' => ActOfAbsorptionEnum::painful(),
            'absorption_difficulty_degree' => 'Հետաքրքրվողների համար ոտորև ներկայացված է 1500-ականներից ի վեր օգտագործվող koko-jambo-ի ստանդարտ տեքստի',

            'abdomen_is_symmetrical' => false,
            'abdomen_is_involved_in_breathing' => false,
            'pain_when_touching_abdomen_comment' => 'Այս տեքստը ոչ միայն կարողացել է գոյատևել հինգ դարաշրջան',

            // 5-th page
            'abdominal_urinary_symptom' => AbdominalUrinarySymptomEnum::weakPositive(),
            'abdominal_urinary_symptom_comment' => 'էջերի թողարկման արդյունքում, իսկ ավելի ուշ համակարգչային տպագրության այնպիսի',
            'liver_is_enlarged' => false,
            'liver_size' => 34,
            'liver_type' => LiverAndSpleenTypeEnum::swollen(),
            'spleen_is_enlarged' => false,
            'spleen_size' => 43,
            'spleen_type' => LiverAndSpleenTypeEnum::solid(),
            'intestinal_peristalsis' => IntestinalPeristalsisEnum::absent(),

            'urogenital_complaints' => 'այլև ներառվել է էլեկտրոնային տպագրության մեջ` մնալով էապես անփոփոխ',
            'urination_type' => UrinationTypeEnum::frequent(),
            'symptom_of_urogenital_distribution' => false,
            'symptom_of_urogenital_distribution_comment' => 'Հակառակ ընդհանուր պատկերացմանը`kokon այդքան էլ պատահական հավաքված տեքստ չէ',
            'status_localis' => 'Եթե ուզում եք օգտագործել koko-jambo, ապա երևի չեք ցանկանա, որ այն պարունակի ինչ-որ',

            'examination_program' => json_encode(StationaryPresentStatus::EXAMINATION_PROGRAM_DEFAULT_ARRAY)
        ]);

        // stationary_present_status_preliminary
        $stationary->stationary_diagnoses()->create([
            "disease_id" => 77,
            "diagnosis_type" => StationaryDiagnosisEnum::stationary_present_status_preliminary(),
            "diagnosis_comment" => "Նկատվում է հիվանդության stationary_present_status_preliminary"
        ]);
    }
}
