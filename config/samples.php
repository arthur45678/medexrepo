<?php

/**
 * list key is a patient relation
 * each relation has name and route name
 * we need route name for link generation
 */

return [

    'list' => [
        // ambulator ans stationary can create only receptionist
        // do not return with other samples (Catalogs\SampleController@groupByTarget())!
        'stationaries' => [
            'name' => 'Ստացիոնար քարտ',
            'relation' => 'stationaries',
            'route_name' => 'patients.stationary',
            'target' => 'patient'
        ],
        'ambulator' => [
            'name' => 'Ամբուլատոր քարտ',
            'relation' => 'ambulator',
            'route_name' => 'patients.ambulator',
            'target' => 'patient'
        ],
        'ultrasound_endoscopic_examinations' => [
            'name' => 'Էնդոսկոպիկ ուլտրաձայնային հետազոտություններ',
            'relation' => 'ultrasound_endoscopic_examinations',
            'route_name' => 'samples.patients.uex',
            'target' => 'patient'
        ],
        'melody' => [
            'name' => 'Հարդ ռոք',
            'route_name' => 'samples.saz',
            'target' => 'bash_nazani'
        ],
        'erythrocyte_morphologies' => [
            'name' => 'Էրիթրոցիտների մորֆոլոգիա',
            'relation' => 'erythrocyte_morphologies',
            'route_name' => 'samples.patients.erythrocyte-morphology',
            'target' => 'patient'
        ],

        'radiation_treatment_card' => [
            'name' => 'Ճառագայթային բուժման քարտ',
            'relation' => 'radiation_treatment_card',
            'route_name' => 'samples.patients.radiation-treatment-card',
            'target' => 'patient'
        ],


        'assignment_sheet' => [
            'name' => 'Նշանակման թերթիկ',
            'relation' => 'patients.assignment_sheet',
            'route_name' => 'samples.patients.assignment_sheet',
            'target' => 'patient'
        ],

        'bix_sterilisation_log' => [
            'name' => 'Բիքսի մանրէազերծման գրանցամատյան',
            'relation' => 'bix_sterilisation_log',
            'route_name' => 'samples.patients.bix-sterilization-log',
            'target' => 'patient'
        ],
        'conscious_voluntary_consents' => [
            'name' => 'Գիտակցված կամավոր համաձայնություն',
            'relation' => 'conscious_voluntary_consents',
            'route_name' => 'samples.patients.conscious-voluntary-consents',
            'target' => 'patient'
        ],

        'echo_cardiograms' => [
            'name' => 'Էխոկարդիոգրաֆիա',
            'relation' => 'echo_cardiograms',
            'route_name' => 'samples.patients.echocardiogram',
            'target' => 'patient'
        ],

        'biochemical_labs_n1' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 1',
            'relation' => 'biochemical_labs_n1',
            'route_name' => 'samples.patients.biochemical-lab-n1',
            'target' => 'patient'
        ],

        'biochemical_labs_n2' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 2',
            'relation' => 'biochemical_labs_n2',
            'route_name' => 'samples.patients.biochemical-lab-n2',
            'target' => 'patient'
        ],

        'biochemical_labs_n3' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 3',
            'relation' => 'biochemical_labs_n3',
            'route_name' => 'samples.patients.biochemical-lab-n3',
            'target' => 'patient'
        ],

        'biochemical_labs_n4' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 4',
            'relation' => 'biochemical_labs_n4',
            'route_name' => 'samples.patients.biochemical-lab-n4',
            'target' => 'patient'
        ],

        'biochemical_labs_n5' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 5',
            'relation' => 'biochemical_labs_n5',
            'route_name' => 'samples.patients.biochemical-lab-n5',
            'target' => 'patient'
        ],

        'biochemical_labs_n7' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 7',
            'relation' => 'biochemical_labs_n7',
            'route_name' => 'samples.patients.biochemical-lab-n7',
            'target' => 'patient'
        ],

        'biochemical_labs_n8' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 8',
            'relation' => 'biochemical_labs_n8',
            'route_name' => 'samples.patients.biochemical-lab-n8',
            'target' => 'patient'
        ],

        'biochemical_labs_n9' => [
            'name' => 'Կենսաքիմիական լաբորատորիա N 9',
            'relation' => 'biochemical_labs_n9',
            'route_name' => 'samples.patients.biochemical-lab-n9',
            'target' => 'patient'
        ],


        'clinical_labs_n2' => [
            'name' => 'Կլինիկական լաբորատորիա N 2',
            'relation' => 'clinical_labs_n2',
            'route_name' => 'samples.patients.clinical-lab-n2',
            'target' => 'patient'
        ],

        'clinical_labs_n11' => [
            'name' => 'Կլինիկական լաբորատորիա N 11',
            'relation' => 'clinical_labs_n11',
            'route_name' => 'samples.patients.clinical-lab-n11',
            'target' => 'patient'
        ],

        'clinical_labs_n12' => [
            'name' => 'Կլինիկական լաբորատորիա N 12',
            'relation' => 'clinical_labs_n12',
            'route_name' => 'samples.patients.clinical-lab-n12',
            'target' => 'patient'
        ],

        'patients_managements' => [
            'name' => 'Օժանդակ - մեխանիկական շնչառությամբ հիվանդների վարում',
            'relation' => 'patients_managements',
            'route_name' => 'samples.patients.patients-management',
            'target' => 'patient'
        ],


        'histological_examinations' => [
            'name' => 'Հյուսվածքաբանական (բջջաբանական) հետազոտություն',
            'relation' => 'histological_examinations',
            'route_name' => 'samples.patients.histological-examination',
            'target' => 'patient'
        ],
        'patients_exprres' => [
            'name' => 'Էքսպրես',
            'relation' => 'patients_exprres',
            'route_name' => 'samples.patients.express-pattern',
            'target' => 'patient'
        ],

        'personalTreatmentPlan' => [
            'name' => 'Անհատական բուժման պլան',
            'relation' => 'personalTreatmentPlan',
            'route_name' => 'samples.patients.personal-treatment-plan',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN1' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N1',
            'relation' => 'ImmunologicalExaminationPatternN1',
            'route_name' => 'samples.patients.iep-n1',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN3' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N3',
            'relation' => 'ImmunologicalExaminationPatternN3',
            'route_name' => 'samples.patients.iep-n3',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN4' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N4',
            'relation' => 'ImmunologicalExaminationPatternN4',
            'route_name' => 'samples.patients.iep-n4',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN5' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N5',
            'relation' => 'ImmunologicalExaminationPatternN5',
            'route_name' => 'samples.patients.iep-n5',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN7' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N7',
            'relation' => 'ImmunologicalExaminationPatternN7',
            'route_name' => 'samples.patients.iep-n7',
            'target' => 'patient'
        ],
        'ImmunologicalExaminationPatternN8' => [
            'name' => 'Իմունաբանական լաբորատորիա բժշկական ձև N8',
            'relation' => 'ImmunologicalExaminationPatternN8',
            'route_name' => 'samples.patients.iep-n8',
            'target' => 'patient'
        ],
        'LampOperationMode' => [
            'name' => 'Լամպի շահագործման ռեժիմ',
            'relation' => 'LampOperationMode',
            'route_name' => 'samples.patients.lamp-operation-mode',
            'target' => 'patient'
        ],
        'PlanningProtocols' => [
            'name' => 'Պլանավորման ուղեգիր',
            'relation' => 'PlanningProtocols',
            'route_name' => 'samples.patients.planning-protocol',
            'target' => 'patient'
        ],

        'medical_waste_register' => [
            'name' => 'Բժշկական թափոնի տեսակ',
            'relation' => 'medical_waste_register',
            'route_name' => 'samples.patients.medical-waste-register',
            'target' => 'patient'
        ],

        'StationaryInpatientRegisters' => [
            'name' => 'Ստացիոնար հիվանդի հաշվառման գրանցամատյան',
            'relation' => 'StationaryInpatientRegisters',
            'route_name' => 'samples.patients.stationary-inpatient-register',
            'target' => 'patient'
        ],

        'drug_destruction_act' => [
            'name' => 'Թմրամիջոցների ոչնչացման ակտ',
            'relation' => 'drug_destruction_act',
            'route_name' => 'samples.patients.drug-destruction-act',
            'target' => 'patient'
        ],

        'microbiology_examination' => [
            'name' => 'Մանրեաբանական լաբորատորիա',
            'relation' => 'microbiology_examination',
            'route_name' => 'samples.patients.microbiology_examination',
            'target' => 'patient'
        ],
        'microbiology_examination_form_2' => [
            'name' => 'Մանրեաբանական լաբորատորիա: Բժշկական ձև 2',
            'relation' => 'microbiology_examination_form_2',
            'route_name' => 'samples.patients.microbiology_examination_form_2',
            'target' => 'patient'
        ],
        'advice_sheet' => [
            'name' => 'Խորհրդատվական թերթիկ',
            'relation' => 'advice_sheet',
            'route_name' => 'samples.patients.advice-sheet',
            'target' => 'patient'
        ],

        /*  'inventory_accounting' => [
              'name' => 'Վիրակապական պարագաների հաշվառում',
              'relation' => 'inventory_accounting',
              'route_name' => 'samples.patients.inventory-accounting',
              'target' => 'patient'
          ],*/
        'advice_sheet_insurance' => [
            'name' => 'Խորհրդատվական ապահովագրական թերթիկ',
            'relation' => 'advice_sheet_insurance',
            'route_name' => 'samples.patients.advice-sheet-insurance',
            'target' => 'patient'
        ],
        'surgery_participants' => [
            'name' => 'Վիրահատության մասնակիցներ',
            'relation' => 'surgery_participants',
            'route_name' => 'samples.patients.surgery-participants',
            'target' => 'patient'
        ],
        'AnesthesiologistPreSurgeryExamination' => [
            'name' => 'Անեսթեզիոլոգի նախավիրահատական զննում',
            'relation' => 'AnesthesiologistPreSurgeryExamination',
            'route_name' => 'samples.patients.ape',
            'target' => 'patient'
        ],
        'StationaryDischargeCard' => [
            'name' => 'Ստացիոնարից դուրս գրվածի վիճակագրական քարտ',
            'relation' => 'StationaryDischargeCard',
            'route_name' => 'samples.patients.stationary-discharge-card',
            'target' => 'patient'
        ],
        'xray_examination_logs' => [
            'name' => 'Ռենտգեն հետազոտությունների հաշվառման մատյան',
            'relation' => 'xray_examination_logs',
            'route_name' => 'samples.patients.xray-examination-log',
            'target' => 'patient'
        ],
        'agreementHospitalRoom' => [
            'name' => 'Համաձայնագիր',
            'relation' => 'AgreementHospitalRoom',
            'route_name' => 'samples.patients.agreement-hospital-room',
            'target' => 'patient'
        ],

        'sterilization_mode_sisters' => [
            'name' => 'Մանրէազերծման ռեժիմ քույր',
            'relation' => 'sterilization_mode_sisters',
            'route_name' => 'samples.patients.sterilization-mode-sister',
            'target' => 'patient'
        ],
        'paidServiceContract' => [
            'name' => 'Բժշկական օգնության և սպասարկման ծառայություններ',
            'relation' => 'paidServiceContract',
            'route_name' => 'samples.patients.paid-service-contract',
            'target' => 'patient'
        ],
        'MedicalCareAccounting' => [
            'name' => 'Դեպքի կարգավիճակ',
            'relation' => 'MedicalCareAccounting',
            'route_name' => 'samples.patients.medical-care-accounting1',
            'target' => 'patient'
        ],
        'CancerPatientControlCard' => [
            'name' => 'Քաղցկեղով հիվանդի հսկիչ քարտ',
            'relation' => 'CancerPatientControlCard',
            'route_name' => 'samples.cpcc',
            'target' => 'patient'
        ],
        'heat_sheet' => [
            'name' => 'Ջերմության թերթիկ',
            'relation' => 'heat_sheet',
            'route_name' => 'samples.patients.heat_sheet',
            'target' => 'patient'
        ],
        'IndividualTreatmentPlan' => [
            'name' => 'Անհատական բուժման պլան',
            'relation' => 'IndividualTreatmentPlan',
            'route_name' => 'samples.patients.individual-treatment-plan',
            'target' => 'patient'
        ],
        'Extract' => [
            'name' => 'Քաղվածք',
            'relation' => 'Extract',
            'route_name' => 'samples.patients.extract',
            'target' => 'patient'
        ],
    ]
];
