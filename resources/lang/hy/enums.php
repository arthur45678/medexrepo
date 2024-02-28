<?php

return [

    "stationary_diagnosis_enum" => [
        'primary_disease' => 'Հիմական հիվանդություն',
        'admission' => 'Ընդուման ախտորոշում',
        'referring_institution' => 'Ուղեգորղ հաստատության ախտորոշում',
        'clinical' => 'Կլինիկական ախտորոշում',
        'final_clinical' => 'Վերջնական կլինիկական ախտորոշում (Ա) Հիմնական',
        'disease_complication' => 'Հիմնական հիվանդության բարդություն (Բ)',
        'concomitant_disease' => 'Ուղեկցող հիվանդության բարդություն (Գ)',
        'tuberculosis_complaint' => 'Տուբերկուլյոզին բնորոշ գանգատներ (Դ)',
        'previous_disease' => 'Նախկինում տարած հիվանդություն',
        'stationary_present_status_preliminary' => 'Նախնական ախտորոշում'
    ],

    "stationary_medicine_side_effect_enum" => [
        'intolerance' => 'Դեղանյութերի կողմնակի ազդեցություններ - Անտանելիություն',
        'allergy' => 'Դեղանյութերի կողմնակի ազդեցություններ - Ալերգիկ երևույթներ',
    ],

    "stationary_surgery_enum" => [
        'stationary' => 'Ատացիոնարի 13-րդ կետ',
        'stationary_primary_examination' => 'Ատացինոնարի առաջնային զննում',
    ],

    "stationary_work_efficiency_enum" => [
        'fully' => "Վերականգնված է լրիվ",
        'partial' => "Վերականգնված է մասնակի",
        'temporary_loss' => "Ժամանակավոր կորուստ",
        'stable_loss' => "Կայուն կորուստ տվյալ հիվանդության հետ կապված",
        'other' => "Կայուն կորուստ ուրիշ պատճառով",
    ],

    "stationary_disease_outcome_enum" => [
        'recovery' => 'Առողջացմամբ',
        'without_change' => 'Առանց փոփոխության',
        'with_improvement' => 'Լավացումով',
        'death' => 'Մահ',
    ],

    "tumor_treatment_enum" => [
        'special_treatment' => "Հատուկ բուժում",
        'palliative' => "Ամոքիչ",
        'symptomatic' => "Ախտանշանային",
    ],

    "stationary_death_circumstance_enum" => [
        'in_reception' => 'ընդունարանում',
        'pregnant_up_to_28_weeks' => 'հղի մինչև 28 շաբաթական հղիությամբ',
        'pregnant_after_28_weeks' => '28 շաբաթ հղիությունից հետո',
        'before_giving_birth' => 'ծննդաբեր',
        'after_giving_birth' => 'ծննդկան',
    ],

    "stationary_age_type_enum" => [
        'year' => 'Ըստ տարիների',
        'month' => 'Ըստ ամիսների',
        'day' => 'Ըստ օրերի',
    ],

    // StationaryPresentStatus
    "position_in_bed_enum" => [
        'active' => 'ակտիվ',
        'passive' => 'պասիվ',
        'forced' => 'հարկադրական',
    ],

    "skin_coverings_enum" => [
        'ordinary' => 'սովորական գույնի',
        'pale' => 'գունատ',
        'cyanotic' => 'ցիանոտիկ',
        'yellow' => 'դեղնուկային',
    ],

    "subcutaneous_fat_enum" => [
        'cachexia' => 'կախեքսիա',
        'undeveloped' => 'թույլ զարագացած',
        'normal' => 'նորմալ',
    ],

    "breathing_type_enum" => [
        'through_the_nose' => 'քթով',
        'through_the_mouth' => 'բերանով',
        'thoracic' => 'կրծքային',
        'abdominal' => 'որովայնային',
    ],

    "tongue_state_enum" => [
        'wet' => 'խոնավ',
        'dry' => 'չոր',
        'glorified' => 'փառակալած',
        'ulcers' => 'խոցեր',
        'aphthae' => 'աֆթաններ',
    ],

    "act_of_absorption_enum" => [
        'free' => 'ազատ',
        'painful' => 'ցավոտ',
        'difficulty' => 'դժվարացած',
    ],

    "abdominal_urinary_symptom_enum" => [
        'negative' => 'բացասական',
        'weak_positive' => 'թույլ դրական',
        'strict_positive' => 'խիստ դրական',
    ],

    "liver_and_spleen_type_enum" => [
        'soft' => 'փափուկ',
        'solid' => 'պինդ',
        'swollen' => 'թմբկավոր',
    ],

    "intestinal_peristalsis_enum" => [
        'active' => 'ակտիվ',
        'weak' => 'թույլ',
        'absent' => 'բացակայում է',
    ],

    "urination_type_enum" => [
        'easy' => 'ազատ',
        'difficult' => 'դժվարացած',
        'painful' => 'ցավոտ',
        'frequent' => 'հաճախացած',
    ],

    "examination_type_enum" => [
        'laboratory_tests_of_blood_and_urine' => 'արյան և մեզի լաբորատոր անալիզներ',
        'electrocardiography' => 'Էլեկտրասրտագրություն',
        'X_ray_of_the_chest_organs' => 'կրծքավանդակի օրգանների ռենտգենյան հետազոտություն',
    ],

    "ultrasoundable_body_part_enum" => [
        'neck_area' => 'պարանոցի շրջան',
        'thyroid' => 'վահանագեղձ',
        'left_breast' => 'ձախ կրծքագեղձ',
        'right_breast' => 'աջ կրծքագեղձ',
        'abdominal_cavity' => 'որովայնի խոռոչի օրգաններ',
        'after_the_abdominal_cavity' => 'հետորովայնամզային տարածության օրգաններ',
        'pelvic_organs' => 'փոքր կոնքի օրգաններ',
    ],

    //StationaryTreatmentEvaluation 20 page
    "eastern_cooperative_oncology_group_enum" => [
        'zero' => 'Լրիվ ակտիվ է, ի վիճակի է կատարել այն աշխատանքը, որը կատարել է մինչև հիվանդանալը՝ առանց սահմանափակումների',
        'first' => 'Կրում է դժվարություններ ֆիզիկական և լարված աշխատանք կատարելիս։ Ի վիճակի է կատարել թեթև կամ նստակյաց աշխատանք',
        'second' => 'Լիովին սպասարկում է իրեն, ի վիճակի չէ աշխատել, օրվա մեծ մասն անցկացնում է անկողնում',
        'third' => 'Սպասարկում է իրեն սահմանափակումներով, ժամանակի կեսից ավելին անցկացնում է անկողնում',
        'forth' => 'Լրիվ հաշմանդամություն։ Ի վիճակի չէ իրեն սպասարկել, գամված է անկողնում',
    ],

    "karnofsky_performance_enum" => [
        'percent_100' => '100% Գանգատներ չկան, չկան հիվանդւոյթյան նշաններ',
        'percent_90' => '90% Ի վիճակի է շարունակել նորմալ ակտիվությունը, առկա են հիվանդւոյթյան նվազագույն նշաններ',
        'percent_80' => '80% Նորմալ ակտիվությունը կատարվում է դժվարությամբ, առկա են հիվանդւոյթյան որոշ նշաններ',
        'percent_70' => '70% Սպասարկում է ինքն իրեն, ի վիճակի չէ շարունակել նորմալ ակտիվությունը, չի կարող աշխատել',
        'percent_60' => '60% Պահանջում է պարբերական օգնություն, ի վիճակի չէ ինքն իրեն սպասարկել',
        'percent_50' => '50% Պահանջում է զգալի ընդհանուր և բժշկական օգնություն',
        'percent_40' => '40% Պահանջում է հատուկ բժշկական օգնություն',
        'percent_30' => '30% Հաշմանդամության ծայրահեղ աստիճան',
        'percent_20' => '20% Կարիք ունի ակտիվ օժանդակ բուժման',
        'percent_10' => '10% Մահացող',
    ],

    "treatment_effectiveness_enum" => [
        'full_regression' => 'ԼՀ - լրիվ հետաճ (ռեգրեսիա)',
        'partial_regression' => 'ՄՀ - մասնակի հետաճ',
        'stabilization' => 'ԿԱ - կայունացում (ստաբիլիզացիա)',
        'progress' => 'ԱՌ - առաջադիմում (պրոգրեսիա)',
    ],

    "service_payment_type_enum" => [
        'paid' => 'Վճարովի',
        'state_order' => 'Պետպատվեր',
        'social_insurance' =>'Սոց․ ապահովագրություն',
        'co_payment' => 'Համավճար'
    ],
];
