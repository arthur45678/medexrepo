<?php

return [

    "stationary_work_efficiency_enum" => [
        'fully' => "Fully",
        'partial' => "Partial",
        'temporary_loss' => "Temporary Loss",
        'stable_loss' => "Stable Loss",
        'other' => "Other",
    ],

    "stationary_disease_outcome_enum" => [
        'recovery' => 'Recovery',
        'without_change' => 'Without Change',
        'with_improvement' => 'With Improvement',
        'death' => 'Death',
    ],

    "tumor_treatment_enum" => [
        'special_treatment' => "Special Treatment",
        'palliative' => "Palliative",
        'symptomatic' => "Symptomatic",
    ],

    "stationary_death_circumstance_enum" => [
        'in_reception' => 'in_reception',
        'pregnant_up_to_28_weeks' => 'pregnant_up_to_28_weeks',
        'pregnant_after_28_weeks' => 'pregnant_after_28_weeks',
        'before_giving_birth' => 'before_giving_birth',
        'after_giving_birth' => 'after_giving_birth',
    ],

    "stationary_age_type_enum" => [
        'year' => 'year',
        'month' => 'month',
        'day' => 'day',
    ],

    // StationaryPresentStatus
    "position_in_bed_enum" => [
        'active' => 'active',
        'passive' => 'passive',
        'forced' => 'forced',
    ],

    "skin_coverings_enum" => [
        'ordinary' => 'ordinary',
        'pale' => 'pale',
        'cyanotic' => 'cyanotic',
        'yellow' => 'yellow',
    ],

    "subcutaneous_fat_enum" => [
        'cachexia' => 'cachexia',
        'undeveloped' => 'undeveloped',
        'normal' => 'normal',
    ],

    "breathing_type_enum" => [
        'through_the_nose' => 'through_the_nose',
        'through_the_mouth' => 'through_the_mouth',
        'thoracic' => 'thoracic',
        'abdominal' => 'abdominal',
    ],

    "tongue_state_enum" => [
        'wet' => 'wet',
        'dry' => 'dry',
        'glorified' => 'glorified',
        'ulcers' => 'ulcers',
        'aphthae' => 'aphthae',
    ],

    "act_of_absorption_enum" => [
        'free' => 'free',
        'painful' => 'painful',
        'difficulty' => 'difficulty',
    ],

    "abdominal_urinary_symptom_enum" => [
        'negative' => 'negative',
        'weak_positive' => 'weak positive',
        'strict_positive' => 'strict positive',
    ],

    "liver_and_spleen_type_enum" => [
        'soft' => 'soft',
        'solid' => 'solid',
        'swollen' => 'swollen',
    ],

    "intestinal_peristalsis_enum" => [
        'active' => 'active',
        'weak' => 'weak',
        'absent' => 'absent',
    ],

    "urination_type_enum" => [
        'easy' => 'easy',
        'difficult' => 'difficult',
        'painful' => 'painful',
        'frequent' => 'frequent',
    ],

    "examination_type_enum" => [
        'laboratory_tests_of_blood_and_urine' => 'laboratory_tests_of_blood_and_urine',
        'electrocardiography' => 'electrocardiography',
        'X_ray_of_the_chest_organs' => 'X_ray_of_the_chest_organs',
    ],

    "ultrasoundable_body_part_enum" => [
        'neck_area' => 'neck_area',
        'thyroid' => 'thyroid',
        'left_breast' => 'left_breast',
        'right_breast' => 'right_breast',
        'abdominal_cavity' => 'abdominal_cavity',
        'after_the_abdominal_cavity' => 'after_the_abdominal_cavity',
        'pelvic_organs' => 'pelvic_organs',
    ],

    // StationaryTreatmentEvaluation 20 page
    "eastern_cooperative_oncology_group_enum" => [
        'zero' => 'zero',
        'first' => 'first',
        'second' => 'second',
        'third' => 'third',
        'forth' => 'forth',
    ],

    "karnofsky_performance_enum" => [
        'percent_100' => 'percent_100',
        'percent_90' => 'percent_90',
        'percent_80' => 'percent_80',
        'percent_70' => 'percent_70',
        'percent_60' => 'percent_60',
        'percent_50' => 'percent_50',
        'percent_40' => 'percent_40',
        'percent_30' => 'percent_30',
        'percent_20' => 'percent_20',
        'percent_10' => 'percent_10',
    ],

    "treatment_effectiveness_enum" => [
        'full_regression' => 'full_regression',
        'partial_regression' => 'partial_regression',
        'stabilization' => 'stabilization',
        'progress' => 'progress',
    ],
];
