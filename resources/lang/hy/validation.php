<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => ':attribute -ը պետք է լինի ոչ շուտ քան :date -ը։', // այսօր
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => ' :attribute դաշտը պետք է լինի ամսաթիվ վաղվանից ոչ ուշ։',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => ':attribute դաշտը սպասում է տրամաբանական այո կամ ոչ արժեք',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => ':attribute դաշտը պետք է լինի ամսաթիվ',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':attribute պետք է լինի :format ֆորմատով ամսաթիվ',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Խնդրում ենք լրացնել աշխատող ։attribute',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'Ընտրված :attribute անվավեր է',
    'file' => ':attribute պետք է լինի ֆայլ',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => ':attribute դաշտը չի կարող պարունակել :max -ից ավել սիմվոլ.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute դաշտը պետք պարունակի առնվազն :min սիմվոլ։',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attribute դաշտը թվային արժեք է',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute դաշտը պարտադիր է։',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => ':attribute և :other դաշտերը պետք է համընկնեն։',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':attribute դաշտը պետք է լինի ունիկալ:',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        //Patient Fields

        "email" => "Էլ․ փոստ",
        "ssn" => "ՀԾՀՀ",
        "f_name" => "Անուն",
        "l_name" => "Ազգանուն",
        "p_name" => "Հայրանուն",
        "password" => "Գաղտնաբառ",
        "c_password" => "Գաղտնաբառի կրկնություն",
        "roles" => "Պաշտոն",
        "phone" => "Հեռախոսահամար",
        "soc_card"=>"ՀԾՀՀ",
        "username"=>"Լոգին",
        "position"=>"Կոչում",

        # ambulator start
        // create form
        "registration_date" => "Հաշվառման վերցնելու ամսաթիվ",
        "first_clinic_date"=> "Հիվանդի առաջին անգամ դիմելու ամսաթիվ",
        "first_discovered_date" => "Հիվանդությունը առաջին հայտնաբերման ամսաթիվ",
        "past_treatments" => "Նախկինում ստացած բուժումներ",

        "attendance_date" => "Հաճախման ամսաթիվ",
        "diagnosis_date" => "Ախտորոշման ամսաթիվ",
        "complaint_text" => "Գանգատի նկարագրություն",
        "complaint_date" => "Գանգատի արձանագրման ամսաթիվ",

        "oad_date" => "Հիվանդության հանդես գալու ամսաթիվ",
        "oad_comment" => "Հիվանդության հանդես գալու նկարագրություն",

        //Diagnosis
        "preliminary_diagnosis" => "Նախնական ախտորոշում",
        "final_diagnosis" => "Վերջնական ախտորոշում",

        //Complaints
        "complaints" => "Հիվանդի Գանգատներ",

        //Disease Onset and Development - OAD | Tumor_infos
        "tumor_description" => "Ուռուցքի նկարագրություն",
        "disease_progression" => "Հիվանդության զարգացում",
        "has_twin" => "Երկվորյակ",

        //Female issues
        "number_of_births" => "Ծննդաբերություններ թիվը",
        "number_of_abortions" => "Վիժումների թիվը",
        "date_of_last_birth" => "Վերջին ծննդաբերության ամսաթիվը",
        "breast_inflammation" => "Կրծքագեղձի բորբոքում",
        "breastfeeding_complications" => "Բարդություններ կրծքով կերակրելու շրջանում",
        "menstruation" => "Դաշտանը",

        // ambulator - health status and prescription
        "health_status_date" => "Ներկայացել է",
        "health_status_text" => "Վիճակը",
        # ambulator end

        // stationary
        "social_package_id" => "Սոցիալական խումբ",
        "primary_disease_diagnosis_id" => "Հիմնական հիվանդության ախտորոշում",
        "primary_disease_diagnosis_comment" => "Հիմնական հիվանդության ախտորոշման ազատ գրառման դաշտը",
        "stage" => "Փուլ",
        // "tnm" => "TNM",

        "admission_date" => "Ընդունման ամսաթիվ",
        "discharge_date" => "Դուրս գրման ամսաթիվ",
        "height" => "Հասակ",
        "weight" => "Քաշ",
        "department_id" => "Բաժանմունք",
        "chamber_id" => "Հիվանդասենյակ",
        "is_paid" => "Հիվանդասենյակի տիպը",
        "bed_id" => "Մահճակալ",
        "days_qty" => "Օրերի քանակ",
        "by_wheelchair" => "Տեղափոխման ձևը",
        "side_effect_medicine_id" => "Դեղանյութերի կողմնակի ազդեցություն",
        "side_effect_medicine_comment" => "Դեղանյութերի կողմնակի ազդեցության գրառում",

        "age" => "Տարիք",
        "age_type" => "Տարիքը ըատ",

        //10.
        "clinical_diagnosis_id" => "Կլինիկական ախտորոշում",
        "clinical_diagnosis_date" => "Կլինիկական ախտորոշման ամսաթիվ",
        "clinical_diagnosis_comment" => "Կլինիկական ախտորոշման գրառում",

        //11.a
        "final_clinical_diagnosis_id" => "Վերջնական կլինիկական ՀԻՄՆԱԿԱՆ ախտորոշում",
        "final_clinical_diagnosis_date" => "Վերջնական կլինիկական ՀԻՄՆԱԿԱՆ ախտորոշման ամսաթիվ",
        "final_clinical_diagnosis_comment" => "Վերջնական կլինիկական ՀԻՄՆԱԿԱՆ ախտորոշման գրառում",

        //11.b
        "underlying_disease_complication_id" => "հիմնական հիվանդության բարդություն",
        "underlying_disease_complication_comment" => "հիմնական հիվանդության բարդության գրառում",

        //11.g
        "concomitant_disease_complication_id" => "ուղեկցող հիվանդության բարդություն",
        "concomitant_disease_complication_comment" => "ուղեկցող հիվանդության բարդության գրառում",

        //11.d
        "tuberculosis_complaints_id" => "տուբերկուլյոզին բնորոշ գանգատներ",
        "tuberculosis_complaints_comment" => "տուբերկուլյոզին բնորոշ գանգատներ - գրառում",

        //11.e
        "malaria_endemic_zone" => "Մալարիայի էնդեմիկ գոտում",

        //12.
        "times_hospitalized" => "Տվյալ տարում հիվանդության կապակցությամբ հոսպիտալացվել է",

        //13.
        "surgery_datetime" => "Վիրահատության ամսաթիվ",
        "surgery_id" => "Վիրահատություն",
        "anesthesia_id" => "Անզգայացման եղանակ",
        "surgery_complication_comment" => "հետվիրահատական բարդություններ",

        //14.1
        "treatment_other_type_id" => "Բուժման այլ տեսակներ",
        "treatment_other_type_comment" => "Բուժման այլ տեսակների գրառումներ",

        //14.2
        "tumor_treatment_id" => " Չարորակ նորագոյություններով հիվանդների համար",

        //15
        "number" => " անաշխատունակության թերթիկի համար",
        "from" => "անաշխատունակության սկիզբ",
        "to" => "անաշխատունակության ավարտ",

        //16.1
        "disease_outcome_id" => "Հիվանդության ելքը",
        "disease_outcome_date" => "դուրս է գրվել",

        //16.2
        "moved_to_clinic_id" => "Տեղափոխվել է այլ հաստատություն",
        "death_circumstance_id" => "մահացել է",

        //17.
        "workability" => "Աշխատունակությունը",
        "workability_comment" => "Աշխատունակության կորստի այլ պատճառներ",

        //18.
        "expertise_conclusion" => "Փորձաքննության ընդունվածների համար, եզրակացություն",

        //19. histological_examination
        // "examination_date" => "Հետազոտության ամսաթիվ", // - արդեն կա
        "examination_number" => "Հհետազոտության եզրակացության համար №",
        "examination" => "Հետազոտության գրառում",

        //end of 19
        "attending_doctor_id" => "Բուժող բժիշկ",
        "department_head_id" => "Բաժանմունքի վարիչ",
        // end --- stationary

        // Stationary Primary examination
        "examination_date" => "Զննման ամսաթիվ",
        "complaints" => "Գանգատներ",
        "anamnesis_morbi" => "Anamnesis Morbi",
        "growth_and_development" => "Աճ և զարգացում",
        "inhertance" => "Ժառանգականություն",
        "sextual_history" => "Սեռական անամնեզ",

        "menarche_age"  => "Menarche",
        "last_mensis" => "Վերջին",
        "menopausa_age" => "Menopausa",
        "number_of_abortions" => "Վիժումների թիվ",
        "number_of_interruptions" => "Արհեստական ընդհատումներ",
        "number_of_births" => "Ծննդաբերություններ",

        "breast_feeding" => "Կրծքով կերակրելը",
        "breast_feeding_comment" => "Կրծքով կերակրելը",

        "taking_hormonal_drugs" => "Հորմոնային դեղերի ընդունում",
        "taking_hormonal_drugs_comment" => "Հորմոնային դեղերի ընդունում",
        "from_clinic_id" => "Ում կողմից է ուղարկված հիվանդը",
        "is_urgent" => "Ստացիոնար է տեղափոխվել անհետաձգելի ցուցումներով",
        "from_disease_start" => "հիվանդության սկզբից",
        "hours_later" => "վնասվածք ստանալուց ժամ անց",
        "is_planned" => "հոսպիտալացվել է պլանային կարգով",
        "referring_diagnosis" => "Ուղեգրող հաստատության ախտորոշում",
        "referring_diagnosis_comment" => "Ուղեգրող հաստատության ախտորոշման գրառում",
        "admission_diagnosis" => "Ախտորոշումն ընդունվելիս",
        "admission_diagnosis_comment" => "Ախտորոշումն ընդունվելիս - գրառում",

        // start --- Status praesens subjetivus et objectivus
        "patient_general_condition" => "Հիվանդի ընդհանուր վիճակ",
        "by_karnowski_scale" => "ըստ Կարնովսկու սանդղակի",
        "consciousness" => "Գիտակցությունը",
        "position_in_bed" => "Դիրքը անկողնում",

        "skin_coverings" => "Մաշկածածկույթները",
        "subcutaneous_fat" => "Ենթամաշկային ճարպաշերտը",
        "varicose_of_lower_extremities" => "Ստորին վեջույթների ենթամաշկային երակների վարիկոզ լայնացում",
        "varicose_of_lower_extremities_comment" => "Ստորին վեջույթների ենթամաշկային երակների վարիկոզ լայնացմամ գրառում",
        "peripheral_edema" => "Ծայրամասային այտուցներ",
        "peripheral_edema_comment" => "Ծայրամասային այտուցների ազատ գրառում",

        "lymph_node" => "Ավշային հանգույցներ",
        "propulsion_system" => "Հենաշարժիչ համակարգ",
        "nervous_system" => "Նյարդային համակարգ",
        "breasts" => "Կրծքագեղձեր",

        "respiratory_complaints" => "Շնչառական գանգատներ",
        "breathing_type" => "Շնչառությունը",
        "lung_collision" => "Թոքերի բախում",
        "listening_breathing" => "Թոքերի լսում",
        "respiratory_movements_frequency_per_minute" => "Շնչառական շարժումների հաճախականությունը (1 րոպեում)",

        "cardiovascular_complaints" => "Սիրտ-անոթային գանգատներ",
        "heart_percutaneous_border" => "Սրտի պերկուտոր սահմաններ",
        "heartbeat" => "Սրտի լսում",
        "vascular_stroke" => "Անոթազարկ",
        "blood_pressure" => "Զարկերակային ճնշում",

        "endocrine_system" => "Էնդոկրին համակարգ",
        "lor_organs" => "LOR օրգաններ",

        "digestive_complaints" => "Մարսողական գանգատներ",
        "tongue_state" => "Լեզուն",
        "act_of_absorption" => "Կլման ակտը",
        "absorption_difficulty_degree" => "կլման ակտի դժվարության աստիճան",
        "abdomen_is_symmetrical" => "Որովայնը (համաչափ|անհամաչափ)",
        "abdomen_is_involved_in_breathing" => "Շնչառությանը (մասնակցում է|չի)",
        "pain_when_touching_abdomen_comment" => "Ցավոտություն շոշափման ժամանակ",
        // end --- Status praesens subjetivus et objectivus


        // Stationary Ultrasound and endoscopy and other examinations
        "examination_comment" => "Հետազոտություն",
        "examination_date" => "Հետազոտության ամսաթիվ",
        "attachments" => "Կից փաստաթղթեր",
        "attachments.*" => "Ֆայլը", // 50 MB
        // end --- Stationary Ultrasound and endoscopy and other examinations

        // Surgery Justification
        "justification" => "Հիմնավորում",
        "date" => "Ամսաթիվ",
        "medical_affairs_deputy_director_id" => "Բուժական գծով փոխտօրեն",
        // end --- Surgery Justification

        // SurgeryProtocol
        "anesthesiologist_id" => "Անեսթեզիստ",
        "surgery_id" => "Վիրահատություն",
        "surgery_name" => "Վիրահատության անվանում",
        "surgery_start" => "Վիրահատության սկիզբ",
        "surgery_end" => "Վիրահատության ավարտ",
        "anesthesia_id" => "Անզգայացման տեսակ",
        "medicine_id" => "Դեղամիջով",
        "anesthesia_process" => "Անզգայացման ընթացք",
        // end --- SurgeryProtocol

        // Stationary ResuscitationDepartment
        "comment" => "Ազատ գրառման դաշտ",
        // end --- Stationary ResuscitationDepartment

        // Stationary Epicrisis
        "epicrisis_date" => "Ամսաթիվ",
        "epicrisis" => "Էպիկիրզ",
        "chief_doctor_id" => "Գլխավոր բժիշկ",
        // end --- Stationary Epicrisis

        // queues
        "select_user_id" =>"Ընտրել բժշկին",

        // api_queues
        "enqueue_date" => "Հերթագրման ամսաթիվ",


        // Radiation Treatment Cart
        'radiation_treatment_at' => 'Ճառագայթային բուժման ամսաթիվը',
        'radiation_therapy_date' => 'Ճառագայթային բուժման ամսաթիվը',

        // Orders
        'price' => 'Գումար',
        'sum_text' => 'Գումար տառերով',

        // BiochemicalLabN1Controller
        'bbe_number' => 'Արյան կենսաքիմիական հետազոտության համար',
        'biopsy_date' => 'Կենսանյութը վերցնելու ամսաթիվ',

        'chamber' => 'Հիվանդասենյակ',
        'sender_doctor_id' => 'Ուղեգրող բժշկ',

        'stationary_id' => 'Հիվանդության պատմագրի համար',
        'glucose' => 'Գլյուկոզ',
        'urine' => 'Միզանյութ',
        'prothrombin' => 'Պրոթրոմբին',
        'amylase' => 'α-ամիլազ',
        'uroamylase' => 'Ուռոամիլազ',

        'research_date' => 'Հետազոտության պատասխանի տրման ամսաթիվ',
        'bix_sterilisation_date' => 'Ամսաթիվ',
        'bix_send_date' => 'Ուղարկման ամսաթիվ',
        'bix_surgery_date' => 'Բիքսի բերման ժամանակը',

        //Բժշկական թափոնի տեսակ
        'date_of_registration' => 'Գրանցված վթարային իրավիճակի հաղորման ամսաթիվ',

        //xray-examination_log
        'examining_doctor_id' => 'Հետազոտությունը իրականացնող բժիշկ',


        // procurement_technical_characteristics - Տեխնիկական բնութագիր-գնման ժամանակացույց
        'invitation_quota_number' => 'հրավերով նախատեսված չափաբաժնի համար',
        'procurement_plan_passcode' => 'Գնումների պլանով նախատեսված միջանցիկ ծածկագիր',
        'name_and_trademark' => 'Անվանումը և ապրանքային նշան',
        'manufacturer_name_and_country' => 'Արտադրողի անվանում և ծագման երկիր',
        'technical_specifications' => 'տեխնիկական բնութագիր',
        'measurement_unit' => 'չափման միավորը',
        'unit_price' => 'միավոր գին',
        'total_price' => 'ընդհանուր գին',
        'total_quantity' => 'ընդհանուր քանակ',
        'address' => 'հասցե',
        'quantities' => 'ենթակա քանակներ',
        'deadlines' => 'ժամկետներ',
        'general' => 'ընդհանուր'
    ],

];
