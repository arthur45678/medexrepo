const mix = require("laravel-mix");

mix.extract().version();

if (!mix.inProduction() && process.env.MIX_BROWSER_SYNC) {
    mix.browserSync({
        proxy: process.env.MIX_BROWSER_SYNC,
        host: process.env.MIX_BROWSER_SYNC,
        open: process.env.MIX_BROWSER_SYNC
    });
}

// Compiler configs
// mix.babelConfig({
//     plugins: ["@babel/plugin-syntax-dynamic-import"]
// });
//     .webpackConfig({
//     module: {
//         rules: [{ parser: { amd: false } }]
//     }
// });

/**  =======VANILLA JS MODULES AND PLUGINS=======  */

//Tail select
mix.js("resources/js/select-pure.js", "public/js");

mix.copy(
    "node_modules/tail.select/css/bootstrap4/tail.select-default.css",
    "public/css"
);

/**  =======END VANILLA JS MODULES AND PLUGINS=======  */

/**  =======JQUERY AND ITS PLUGINS=======  */
mix.js("resources/js/jquery.js", "public/js");

// magicsearch
mix.copy(
    "node_modules/magicsearch/dist/css/jquery.magicsearch.min.css",
    "public/css"
);

mix.scripts(
    [
        "node_modules/magicsearch/dist/js/jquery.magicsearch.js",
        "resources/js/magicsearch.config.js"
    ],
    "public/js/all.magicsearch.js"
);

//Datatables
mix.js("resources/js/datatables.js", "public/js");

mix.copy(
    "node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css",
    "public/css"
);

mix.copy(
    "node_modules/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css",
    "public/css"
);

/**  =======END JQUERY AND ITS PLUGINS=======  */

/**  =======Broadcasting=======  */

mix.js("resources/js/broadcast.js", "public/js");

/**  =======END Broadcasting=======  */

/** =======REACT COMPONENTS======= */

//Components
mix.react("resources/js/components/List.js", "public/js/components").react(
    "resources/js/components/Select.js",
    "public/js/components"
);

mix.react(
    "resources/js/components/ReceivedReferrals.js",
    "public/js/components"
);

/** =======END REACT COMPONENTS======= */

/** =======CORE UI SCRIPTS AND CSS======= */

// css
mix.copy("resources/vendors/pace-progress/css/pace.min.css", "public/css");

// mix.copy(
//     "node_modules/@coreui/coreui-chartjs/dist/css/coreui-chartjs.css",
//     "public/css"
// );

// general scripts and bundles
mix.copy("node_modules/pace-progress/pace.min.js", "public/js");
mix.copy(
    "node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js",
    "public/js"
);
// mix.copy("node_modules/chart.js/dist/Chart.min.js", "public/js");

// mix.copy(
//     "node_modules/@coreui/coreui-chartjs/dist/js/coreui-chartjs.bundle.js",
//     "public/js"
// );

// scripts
mix.copy("resources/js/coreui/main.js", "public/js");
mix.copy("resources/js/coreui/colors.js", "public/js");
// mix.copy("resources/js/coreui/charts.js", "public/js");
mix.copy("resources/js/coreui/widgets.js", "public/js");
mix.copy("resources/js/coreui/popovers.js", "public/js");
mix.copy("resources/js/coreui/tooltips.js", "public/js");

/** =======END CORE UI SCRIPTS AND CSS======= */

/** =======APP STYLES======= */

//main css
mix.sass("resources/sass/style.scss", "public/css");

//print

//ambulator
mix.sass("resources/sass/print/ambulator.scss", "public/css/print");

//stationary
mix.sass("resources/sass/print/stationary.scss", "public/css/print");

//anesthesiology
mix.sass("resources/sass/print/anesthesiology.scss", "public/css/print");

//prescription
mix.sass("resources/sass/print/prescription.scss", "public/css/print");

//epicrise
mix.sass("resources/sass/print/epicrise.scss", "public/css/print");

//blood_biochemical_examination
mix.sass(
    "resources/sass/print/blood_biochemical_examination.scss",
    "public/css/print"
);

//ultrasound_endoscopic_examination
mix.sass(
    "resources/sass/print/ultrasound_endoscopic_examination.scss",
    "public/css/print"
);

//echocardiogram
mix.sass("resources/sass/print/echocardiogram.scss", "public/css/print");

//erythrocyte-morphology
mix.sass(
    "resources/sass/print/erythrocyte_morphology.scss",
    "public/css/print"
);

//urine_analisis
mix.sass("resources/sass/print/urine_analysis.scss", "public/css/print");

//microscopy
mix.sass("resources/sass/print/microscopy.scss", "public/css/print");

//microscopy
mix.sass(
    "resources/sass/print/blood_transfusion_record_book.scss",
    "public/css/print"
);

//radiation_treatment_cart
mix.sass(
    "resources/sass/print/radiation_treatment_cart.scss",
    "public/css/print"
);

//radiation_treatment_cart
mix.sass(
    "resources/sass/print/hospitalization_referral.scss",
    "public/css/print"
);

//personal_treatment_plan
mix.sass(
    "resources/sass/print/personal_treatment_plan.scss",
    "public/css/print"
);

//awareness_sheet
mix.sass("resources/sass/print/awareness_sheet.scss", "public/css/print");

//awareness_sheet
mix.sass("resources/sass/print/conscious_voluntary_consents.scss", "public/css/print");

//cash_entry_orders
mix.sass("resources/sass/print/cash_entry_order.scss", "public/css/print");

//exit_cash_order
mix.sass("resources/sass/print/exit_cash_order.scss", "public/css/print");

//surgery_participants
mix.sass("resources/sass/print/surgery_participants.scss", "public/css/print");

//refferal_outpatient_examinations
mix.sass("resources/sass/print/refferal_outpatient_examinations.scss", "public/css/print");

//references
mix.sass("resources/sass/print/reference.scss", "public/css/print");

//medical_waste_register
mix.sass("resources/sass/print/medical_waste_register.scss", "public/css/print");

//bix_sterilization_log
mix.sass("resources/sass/print/bix_sterilization_log.scss", "public/css/print");

///planning_protocol
mix.sass("resources/sass/print/planning_protocol.scss", "public/css/print");

//xray_examination_log
mix.sass("resources/sass/print/xray_examination_log.scss", "public/css/print");

//patients_management
mix.sass("resources/sass/print/patients_management.scss", "public/css/print");

 //clinical_lab_n2
mix.sass("resources/sass/print/clinical_lab_n2.scss", "public/css/print");

//clinical_lab_n11
mix.sass("resources/sass/print/clinical_lab_n11.scss", "public/css/print");

//clinical_lab_n12
mix.sass("resources/sass/print/clinical_lab_n12.scss", "public/css/print");

//biochemical_lab_n1
mix.sass("resources/sass/print/biochemical_labs.scss", "public/css/print");

//pharmacy
mix.sass("resources/sass/print/pharmacy.scss", "public/css/print");

//express_paterrn
mix.sass("resources/sass/print/express_paterrn.scss", "public/css/print");

//lamp_operation_mode
mix.sass("resources/sass/print/lamp_operation_mode.scss", "public/css/print");

//stationary_inpatient_register
mix.sass("resources/sass/print/stationary_inpatient_register.scss", "public/css/print");

//histological_examination
mix.sass("resources/sass/print/histological_examination.scss", "public/css/print");

//immunological_examination_pattern_n1
mix.sass("resources/sass/print/immunological_examination_pattern_n1.scss", "public/css/print");

//immunological_examination_pattern_n2
mix.sass("resources/sass/print/immunological_examination_pattern_n2.scss", "public/css/print");

//immunological_examination_pattern_n3
mix.sass("resources/sass/print/immunological_examination_pattern_n3.scss", "public/css/print");

//immunological_examination_pattern_n4
mix.sass("resources/sass/print/immunological_examination_pattern_n4.scss", "public/css/print");

//immunological_examination_pattern_n5
mix.sass("resources/sass/print/immunological_examination_pattern_n5.scss", "public/css/print");

//immunological_examination_pattern_n7
mix.sass("resources/sass/print/immunological_examination_pattern_n7.scss", "public/css/print");

//immunological_examination_pattern_n8
mix.sass("resources/sass/print/immunological_examination_pattern_n8.scss", "public/css/print");

//advice_sheet
mix.sass("resources/sass/print/advice_sheet.scss", "public/css/print");

//drug_destruction_act
mix.sass("resources/sass/print/drug_destruction_act.scss", "public/css/print");

//stationary_discharge_card
mix.sass("resources/sass/print/stationary_discharge_card.scss", "public/css/print");

//inventory_accounting
mix.sass("resources/sass/print/inventory_accounting.scss", "public/css/print");

//advice_sheet_insurance
mix.sass("resources/sass/print/advice_sheet_insurance.scss", "public/css/print");


//sterilization_mode_sister
mix.sass("resources/sass/print/sterilization_mode_sister.scss", "public/css/print");


//agreement_hospital_rooms
mix.sass("resources/sass/print/agreement_hospital_room.scss", "public/css/print");


//paid_service_contract
mix.sass("resources/sass/print/paid_service_contract.scss", "public/css/print");


//procurement_technical_characteristics
mix.sass("resources/sass/print/procurement_technical_characteristics.scss", "public/css/print");


//individual_treatment_plan
mix.sass("resources/sass/print/individual_treatment_plan.scss", "public/css/print");


//cancer_patient_control_card
mix.sass("resources/sass/print/cancer_patient_control_card.scss", "public/css/print");


//medical_care_accounting1
mix.sass("resources/sass/print/medical_care_accounting1.scss", "public/css/print");


//medical_care_accounting1
mix.sass("resources/sass/print/accounting_for_research.scss", "public/css/print");



//heat_sheet
mix.sass("resources/sass/print/heat_sheet.scss", "public/css/print");


//extract
mix.sass("resources/sass/print/extract.scss", "public/css/print");


//work_time_bulletin
mix.sass("resources/sass/print/work_time_bulletin.scss", "public/css/print");

//Login-page
mix.sass("resources/sass/login.scss", "public/css");

/** =======END APP STYLES======= */

/** =======OTHER ASSETS======= */

//fonts
mix.copy("node_modules/@coreui/icons/fonts", "public/fonts");

//icons
mix.copy("node_modules/@coreui/icons/css/free.min.css", "public/css");
mix.copy("node_modules/@coreui/icons/css/brand.min.css", "public/css");
// mix.copy("node_modules/@coreui/icons/css/flag.min.css", "public/css");
// mix.copy("node_modules/@coreui/icons/svg/flag", "public/svg/flag");

mix.copy("node_modules/@coreui/icons/sprites/", "public/icons/sprites");

//images
mix.copyDirectory("resources/assets", "public/assets");
//calendar
mix.styles("resources/css/calendar/evo-calendar.css", "public/assets/calendar/css/evo-calendar.css");
mix.scripts("resources/js/calendar/evo-calendar.js", "public/assets/calendar/js/evo-calendar.js");
mix.scripts("resources/js/calendar/my-calendar.js", "public/assets/calendar/js/my-calendar.js");
mix.scripts("resources/js/calendar/jquery-3.5.1.min.js", "public/assets/calendar/js/jquery-3.5.1.min.js");
/** =======END OTHER ASSETS======= */
