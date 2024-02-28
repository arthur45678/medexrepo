<?php

use App\Http\Middleware\ModeratorPermission;
use Illuminate\Support\Facades\Route;

Route::get('/patients/laboratory', function () {
    return view('index');
});

Route::prefix('armed')->namespace('Armed')->group(function () {
    Route::get("/", "IndexController@index");
    Route::post("/store_patient", "IndexController@store_patient");
    Route::get("/insert_patient", "IndexController@insert_patient");
});



Route::get("/received", "DocumentsController@received")->name('documents.received-list');

Route::get("/documents/generate", "DocumentsController@create")->name("documents.generate");
Route::post("/documents/generate", "DocumentsController@store")->name("documents.store");

Route::middleware('auth_token')->namespace('Api')->group(function () {
    Route::get("/app/patients/{patients}/stationary/{stationary}/pdf", "StationaryController@get_stationary_pdf")->name('patients.stationary.auth_pdf');
    Route::get("/app/patients/{patients}/ambulator/{ambulator}/pdf", "AmbulatorController@get_ambulator_pdf")->name('patients.ambulator.auth_pdf');

    Route::get("/app/patients/{patients}/erythrocyte_morphologies/{erythrocytemorphology}/pdf", "Samples\Pdf\ErythrocyteMorphologyController@get__pdf")->name('patients.erythrocyte_morpholog.auth_pdf');
    Route::get("/app/patients/{patients}/AnesthesiologistPreSurgeryExamination/{ape}/pdf", "Samples\Pdf\AnesthesiologistPreSurgeryExaminationController@get_ape_pdf1")->name('patients.get_ape_pdf.auth_pdf');
    Route::get("/app/patients/{patients}/radiation_treatment_card/{rtc}/pdf", "Samples\Pdf\RadiationsCardsTreatmentsController@get_radiation_treatment_card_pdf")->name('patients.rtc.auth_pdf');
    Route::get("/app/patients/{patients}/ultrasound_endoscopic_examinations/{uex}/pdf", "Samples\Pdf\UltrasoundEndoscopicExaminationController@get_uex_pdf")->name('patients.uex.auth_pdf');

    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN1/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep1");
    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN3/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep3");
    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN4/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep4");
    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN5/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep5");
    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN7/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep7");
    Route::get("/app/patients/{patients}/ImmunologicalExaminationPatternN8/{iep}/pdf", "Samples\Pdf\ImmunologicalExaminationPatternController@iep8");
    Route::get("/app/patients/{patients}/bix_sterilisation_log/{id}/pdf", "Samples\Pdf\BixSterilizationLogController@get_bix_pdf");
    Route::get("/app/patients/{patients}/conscious_voluntary_consents/{id}/pdf", "Samples\Pdf\ConsciousVoluntaryConsentController@get_pdf");
    Route::get("/app/patients/{patients}/echo_cardiograms/{id}/pdf", "Samples\Pdf\EchocardiogramController@get_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n1/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_1_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n2/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_2_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n3/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_3_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n4/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_4_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n5/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_5_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n7/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_7_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n8/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_8_pdf");
    Route::get("/app/patients/{patients}/biochemical_labs_n9/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_9_pdf");
    Route::get("/app/patients/{patients}/histological_examinations/{id}/pdf", "Samples\Pdf\HistologicalExaminationController@get_pdf");
    Route::get("/app/patients/{patients}/patients_exprres/{id}/pdf", "Samples\Pdf\ExpressPaterrnController@get_pdf");
    Route::get("/app/patients/{patients}/personalTreatmentPlan/{id}/pdf", "Samples\Pdf\PersonalTreatmentPlanController@get_pdf");
    Route::get("/app/patients/{patients}/LampOperationMode/{id}/pdf", "Samples\Pdf\LampOperationModeController@get_pdf");

//    Route::get("/app/patients/{patients}/patients-management/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_9_pdf"); show dashty chka

    Route::get("/app/patients/{patients}/PlanningProtocols/{id}/pdf", "Samples\Pdf\PlanningProtocolController@get_pdf");
    Route::get("/app/patients/{patients}/medical_waste_register/{id}/pdf", "Samples\Pdf\MedicalWasteRegisterController@get_pdf");
    Route::get("/app/patients/{patients}/clinical_labs_n2/{id}/pdf", "Samples\Pdf\ClinicalLabController@get_pdf_n2");
    Route::get("/app/patients/{patients}/clinical_labs_n11/{id}/pdf", "Samples\Pdf\ClinicalLabController@get_pdf_n11");
    Route::get("/app/patients/{patients}/clinical_labs_n12/{id}/pdf", "Samples\Pdf\ClinicalLabController@get_pdf_n12");
    Route::get("/app/patients/{patients}/StationaryInpatientRegisters/{id}/pdf", "Samples\Pdf\StationaryInpatientRegisterController@get_pdf");
    Route::get("/app/patients/{patients}/drug_destruction_act/{id}/pdf", "Samples\Pdf\DrugDestructionActController@get_pdf");
    Route::get("/app/patients/{patients}/Extract/{id}/pdf", "Samples\Pdf\ExtractController@get_pdf");
    Route::get("/app/patients/{patients}/microbiology_examination/{id}/pdf", "Samples\Pdf\MicrobiologyExaminationController@get_pdf");
    Route::get("/app/patients/{patients}/microbiology_examination_form_2/{id}/pdf", "Samples\Pdf\MicrobiologyExaminationController_Form_2@get_pdf");
    Route::get("/app/patients/{patients}/advice_sheet/{id}/pdf", "Samples\Pdf\AdviceSheetController@get_pdf");
    Route::get("/app/patients/{patients}/advice_sheet_insurance/{id}/pdf", "Samples\Pdf\AdviceSheetInsuranceController@get_pdf");
    Route::get("/app/patients/{patients}/surgery_participants/{id}/pdf", "Samples\Pdf\SurgeryParticipantsController@get_pdf");
    Route::get("/app/patients/{patients}/xray_examination_log/{id}/pdf", "Samples\Pdf\XrayExaminationLogController@get_pdf");
    Route::get("/app/patients/{patients}/sterilization_mode_sisters/{id}/pdf", "Samples\Pdf\SterilizationModeSisterController@get_pdf");
    Route::get("/app/patients/{patients}/AgreementHospitalRoom/{id}/pdf", "Samples\Pdf\AgreementHospitalRoomController@get_pdf");
    Route::get("/app/patients/{patients}/paid_service_contract/{id}/pdf", "Samples\Pdf\PaidServiceContractController@get_pdf");
    Route::get("/app/patients/{patients}/heat_sheet/{id}/pdf", "Samples\Pdf\HeatSheetController@get_pdf");
    Route::get("/app/patients/{patients}/IndividualTreatmentPlan/{id}/pdf", "Samples\Pdf\IndividualTreatmentPlanController@get_pdf");
    Route::get("/app/patients/{patients}/patients-management/{id}/pdf", "Samples\Pdf\PatientsManagementController@get_pdf");
    Route::get("/app/patients/{patients}/medical-care-accounting1/{id}/pdf", "Samples\Pdf\MedicalCareAccounting1Controller@get_pdf");
    Route::get("/app/patients/{patients}/assignment_sheet/{id}/pdf", "Samples\Pdf\PrescriptionController@get_pdf");
//    Route::get("/app/patients/{patients}/patients-management/{id}/pdf", "Samples\Pdf\BiochemicalLabController@get_9_pdf");


});


Route::group(["middleware" => "auth"], function () {
    # START testing (or download) PDF
    Route::get("/patients/{patients}/stationary/{stationary}/pdf", "DocumentsController@get_stationary_pdf")->name('patients.stationary.pdf');
    Route::get("/patients/{patients}/ambulator/{ambulator}/pdf", "DocumentsController@get_ambulator_pdf")->name('patients.ambulator.pdf');
    Route::get("/patients/{patients}/uex/{uex}/pdf", "DocumentsController@get_uex_pdf")->name('patients.uex.pdf');
    Route::get("/patients/{patients}/erythrocyte-morphology/{erythrocyte_morphology}/pdf", "DocumentsController@get_erythrocyte_morphology_pdf")->name('patients.erythrocyte_morpholog.pdf');
    Route::get("/patients/{patients}/ape/{ape}/pdf", "DocumentsController@get_ape_pdf")->name('patients.ape.pdf');
    Route::get("/patients/{patients}/radiation-treatment-card/{rtc}/pdf", "DocumentsController@get_radiation_treatment_card_pdf")->name('patients.rtc.pdf');

    Route::get("/patients/{patients}/radiation-treatment-card/{rtc}/pdf", "DocumentsController@get_radiation_treatment_card_pdf")->name('patients.rtc.pdf');
    # END testing PDF

    Route::resource('structure', 'StructureController');
    Route::post('referenceUpdateDate', 'ReferralController@UpdateDate')->name('reference.UpdateDate');

    Route::get("/referrals/patients/services", "ReferralController@servicesIndex")->name("referrals.patients.services");
    Route::get("/referrals/patients/received", "ReferralController@receivedIndex")->name("referrals.patients.received");
    Route::get("/referrals/patients/received/assigned", "ReferralController@receivedAssigned")->name("referrals.patients.received.assigned");
    Route::get("/referrals/patients/received/not_assigned", "ReferralController@receivedNotAssigned")->name("referrals.patients.received.not_assigned");
    Route::get("/referrals/patients/received/{referral_id}", "ReferralController@show")->name("referrals.patients.received.show");


    Route::get("/referrals/patients/sent", "ReferralController@sentIndex")->name("referrals.patients.sent");
    Route::get("/referrals/patients/sent_others", "ReferralController@sentOthers")->name("referrals.patients.sent_others");
    Route::get("/referrals/patients/sent/{referral_id}", "ReferralController@sentShow")->name("referrals.patients.sent.show");


    Route::post("/referrals/{referral_id}/accept", "ReferralController@accept")->name("referrals.accept");
    Route::post("/referrals/{referral_id}/destroy", "ReferralController@destroy")->name("referrals.destroy");
    Route::post("/referrals/{referral_id}/finish", "ReferralController@finish")->name("referrals.finish");

    Route::resource('patients.referrals', 'ReferralController', ["only" => ["index", "create", "store"]]);
    Route::get("/patients/{patient}/referrals/create_service_dev", "ReferralController@create_service_dev")
    ->name("patients.referrals.create_service_dev");

    // NonMedicalReferralController
    Route::resource('nonmedical-referrals', 'NonMedicalReferralController', ["only" => ["index", "create", "store"]]);


    Route::patch("/approvements/{approvement}", "ApprovementController@updateApprovementStatus")->name("approvements.update");

    Route::delete("/attachments/{attachable}", "AttachmentsController@destroy")->name("attachments.delete");

    Route::get('/rowgroup', "PatientsController@rowgroup");

    Route::resource('patients', 'PatientsController', ["except" => ["delete"]]);
    Route::get('archivepatients', 'PatientsController@showarchives')->name('archivepatients');
    Route::post('patients/store_file', 'PatientsController@store_file')->name('patients.store_file');
    Route::get('patients/{patient}/barcode', 'PatientsController@barcode')->name('patients.barcode');

    Route::post("/load_data", "PatientsController@load_from_armed")->name("patients.load_from_armed");

    Route::resource('patients.ambulator', 'AmbulatorsController', ["except" => ["delete"]]);
    Route::resource('patients.ambulator.approvement', 'AmbulatorsHasManySectionsController');
    Route::post('patients.ambulator.trash/{data}/{id}', 'AmbulatorsHasManySectionsController@trash')->name('ambulator.trash');
    Route::resource('patients.stationary', 'StationaryController', ["except" => ["delete"]]);

    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_attendances', 'AmbulatorsController@update_attendances')->name('patients.ambulator.update_attendances');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_diagnosis', 'AmbulatorsController@update_diagnosis')->name('patients.ambulator.update_diagnosis');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_complaints', 'AmbulatorsController@update_complaints')->name('patients.ambulator.update_complaints');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_tnms', 'AmbulatorsController@update_tnms')->name('patients.ambulator.update_tnms');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_female_issues', 'AmbulatorsController@update_female_issues')->name('patients.ambulator.update_female_issues');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_onset_and_developments', 'AmbulatorsController@update_onset_and_developments')->name('patients.ambulator.update_onset_and_developments');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_tumor_info', 'AmbulatorsController@update_tumor_info')->name('patients.ambulator.update_tumor_info');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_is_a_twin', 'AmbulatorsController@update_is_a_twin')->name('patients.ambulator.update_is_a_twin');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_health_statuses', 'AmbulatorsController@update_health_statuses')->name('patients.ambulator.update_health_statuses');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_cancer_groups', 'AmbulatorsController@update_cancer_groups')->name('patients.ambulator.update_cancer_groups');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_first_infos', 'AmbulatorsController@update_first_infos')->name('patients.ambulator.update_first_infos');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_regis_date', 'AmbulatorsController@update_regis_date')->name('patients.ambulator.update_regis_date');
    Route::patch('/patients/{patient}/ambulator/{ambulator}/update_harmfuls', 'AmbulatorsController@update_harmfuls')->name('patients.ambulator.update_harmfuls');


    Route::post('/ambulator/{ambulator}/delete_first_infos', 'AmbulatorsController@delete_first_infos')->name('ambulator.delete_first_infos');
    Route::post('/ambulator/{ambulator}/delete_cancer_groups', 'AmbulatorsController@delete_cancer_groups')->name('ambulator.delete_cancer_groups');
    Route::post('/ambulator/{ambulator}/delete_tnms', 'AmbulatorsController@delete_tnms')->name('ambulator.delete_tnms');
    Route::post('/ambulator/{ambulator}/delete_diagnosis', 'AmbulatorsController@delete_diagnosis')->name('ambulator.delete_diagnosis');
    Route::post('/ambulator/{ambulator}/delete_previous_diagnosis', 'AmbulatorsController@delete_previous_diagnosis')->name('ambulator.delete_previous_diagnosis');
    Route::delete('/ambulator/{ambulator}/delete_attendances', 'AmbulatorsController@delete_attendances')->name('ambulator.delete_attendances');
    Route::post('/ambulator/{ambulator}/delete_complaints', 'AmbulatorsController@delete_complaints')->name('ambulator.delete_complaints');
    // Route::post('/ambulator/{ambulator}/delete_female_issues', 'AmbulatorsController@delete_female_issues')->name('ambulator.delete_female_issues');
    Route::post('/ambulator/{ambulator}/delete_onset_and_developments', 'AmbulatorsController@delete_onset_and_developments')->name('ambulator.delete_onset_and_developments');
    Route::post('/ambulator/{ambulator}/delete_tumor_info', 'AmbulatorsController@delete_tumor_info')->name('ambulator.delete_tumor_info');
    Route::post('/ambulator/{ambulator}/delete_health_statuses', 'AmbulatorsController@delete_health_statuses')->name('ambulator.delete_health_statuses');
    Route::post('/ambulator/{ambulator}/delete_hs_prescriptions', 'AmbulatorsController@delete_hs_prescriptions')->name('ambulator.delete_hs_prescriptions');


    Route::get("/patients/{patient}/stationary/{stationary}/sections", "StationaryHasManySectionsController@index")->name("patients.stationary.sections");
    Route::get("/patients/{patient}/stationary/{stationary}/sections2", "StationaryHasManySectionsController@index2")->name("patients.stationary.sections2");

    Route::put("/stationary/update_many_surgeries", "StationaryHasManySectionsController@update_many_surgeries")->name("patients.stationary.update_many_surgeries");
    Route::post("/patient/{patient}/stationary/{stationary}/create_surgery", "StationaryHasManySectionsController@create_surgery")->name("patients.stationary.create_surgery");
    Route::post("/stationary/delete_surgeries", "StationaryHasManySectionsController@delete_surgeries")->name("patients.stationary.delete_surgeries");

    Route::put("/stationary/update_many_diagnoses", "StationaryHasManySectionsController@update_many_diagnoses")->name("patients.stationary.update_many_diagnoses");
    Route::put("/patient/{patient}/stationary/{stationary}/update_diagnosis", "StationaryHasManySectionsController@update_diagnosis")->name("patients.stationary.update_diagnosis");
    Route::post("/patient/{patient}/stationary/{stationary}/create_many_diagnoses", "StationaryHasManySectionsController@create_many_diagnoses")->name("patients.stationary.create_many_diagnoses");

    Route::post("/patient/{patient}/stationary/{stationary}/create_other_treatment", "StationaryHasManySectionsController@create_other_treatment")->name("patients.stationary.create_other_treatment");
    Route::put("/stationary/update_other_treatments", "StationaryHasManySectionsController@update_other_treatments")->name("patients.stationary.update_other_treatments");
    Route::post("/stationary/delete_other_treatments", "StationaryHasManySectionsController@delete_other_treatments")->name("patients.stationary.delete_other_treatments");

    Route::post("/patient/{patient}/stationary/{stationary}/create_social_package", "StationaryHasManySectionsController@create_social_package")->name("patients.stationary.create_social_package");
    Route::put("/stationary/update_social_packages", "StationaryHasManySectionsController@update_social_packages")->name("patients.stationary.update_social_packages");
    Route::post("/stationary/delete_social_packages", "StationaryHasManySectionsController@delete_social_packages")->name("patients.stationary.delete_social_packages");


    Route::post("/patient/{patient}/stationary/{stationary}/create_disability_certificate", "StationaryHasManySectionsController@create_disability_certificate")->name("patients.stationary.create_disability_certificate");
    Route::put("/stationary/update_disability_certificates", "StationaryHasManySectionsController@update_disability_certificates")->name("patients.stationary.update_disability_certificates");
    Route::post("/stationary/delete_disability_certificates", "StationaryHasManySectionsController@delete_disability_certificates")->name("patients.stationary.delete_disability_certificates");

    Route::post("/patient/{patient}/stationary/{stationary}/create_many_medicine_side_effects", "StationaryHasManySectionsController@create_many_medicine_side_effects")->name("patients.stationary.create_many_medicine_side_effects");
    Route::put("/stationary/update_medicine_side_effects", "StationaryHasManySectionsController@update_medicine_side_effects")->name("patients.stationary.update_medicine_side_effects");


    Route::post("/patient/{patient}/stationary/{stationary}/create_expertise_conclusion", "StationaryHasManySectionsController@create_expertise_conclusion")->name("patients.stationary.create_expertise_conclusion");
    Route::put("/stationary/update_expertise_conclusions", "StationaryHasManySectionsController@update_expertise_conclusions")->name("patients.stationary.update_expertise_conclusions");
    Route::post("/stationary/delete_expertise_conclusions", "StationaryHasManySectionsController@delete_expertise_conclusions")->name("patients.stationary.delete_expertise_conclusions");


    Route::post("/patient/{patient}/stationary/{stationary}/create_histological_examination", "StationaryHasManySectionsController@create_histological_examination")->name("patients.stationary.create_histological_examination");
    Route::put("/stationary/update_histological_examinations", "StationaryHasManySectionsController@update_histological_examinations")->name("patients.stationary.update_histological_examinations");
    Route::post("/stationary/delete_histological_examinations", "StationaryHasManySectionsController@delete_histological_examinations")->name("patients.stationary.delete_histological_examinations");


    # Stationary Relations - delete
    Route::post("/stationary/{stationary}/delete_reset_diagnoses", "StationaryHasManySectionsController@delete_reset_diagnoses")->name("patients.stationary.delete_reset_diagnoses");
    Route::post("/stationary/delete_diagnoses", "StationaryHasManySectionsController@delete_diagnoses")->name("patients.stationary.delete_diagnoses");
    Route::post("/stationary/delete_medicine_side_effects", "StationaryHasManySectionsController@delete_medicine_side_effects")->name("patients.stationary.delete_medicine_side_effects");

    Route::post("/stationary/delete_treatment_evaluation", "StationaryController@delete_treatment_evaluation")->name("patients.stationary.delete_treatment_evaluation");
    Route::post("/stationary/delete_special_note", "StationaryController@delete_special_note")->name("patients.stationary.delete_special_note");
    Route::post("/stationary/delete_pathological_anatomical", "StationaryController@delete_pathological_anatomical")->name("patients.stationary.delete_pathological_anatomical");
    Route::post("/stationary/delete_epicrisis", "StationaryController@delete_epicrisis")->name("patients.stationary.delete_epicrisis");
    Route::post("/stationary/delete_resuscitation_department", "StationaryController@delete_resuscitation_department")->name("patients.stationary.delete_resuscitation_department");
    Route::post("/stationary/delete_disease_course", "StationaryController@delete_disease_course")->name("patients.stationary.delete_disease_course");
    Route::post("/stationary/delete_surgery_description", "StationaryController@delete_surgery_description")->name("patients.stationary.delete_surgery_description");
    Route::post("/stationary/delete_surgery_protocol", "StationaryController@delete_surgery_protocol")->name("patients.stationary.delete_surgery_protocol");
    Route::post("/stationary/delete_surgery_justification", "StationaryController@delete_surgery_justification")->name("patients.stationary.delete_surgery_justification");
    Route::post("/stationary/delete_for_analysis", "StationaryController@delete_for_analysis")->name("patients.stationary.delete_for_analysis");
    Route::post("/stationary/delete_expert_advice", "StationaryController@delete_expert_advice")->name("patients.stationary.delete_expert_advice");
    Route::post("/stationary/delete_cellular_examination", "StationaryController@delete_cellular_examination")->name("patients.stationary.delete_cellular_examination");
    Route::post("/stationary/delete_xray_examination", "StationaryController@delete_xray_examination")->name("patients.stationary.delete_xray_examination");
    Route::post("/stationary/delete_ultrasound_endoscopy", "StationaryController@delete_ultrasound_endoscopy")->name("patients.stationary.delete_ultrasound_endoscopy");
    Route::post("/stationary/delete_present_status", "StationaryController@delete_present_status")->name("patients.stationary.delete_present_status");
    Route::post("/stationary/delete_primary_examination", "StationaryController@delete_primary_examination")->name("patients.stationary.delete_primary_examination");

    Route::post("/patients/{patient}/stationary/{stationary}/present_status", "StationaryController@present_status")->name("patients.stationary.present_status");
    Route::patch("/patients/{patient}/stationary/{stationary}/primary_examination", "StationaryController@update_primary_examination")->name("patients.stationary.primary_examination");
    Route::patch("/patients/{patient}/stationary/{stationary}/ultrasound_endoscopy", "StationaryController@ultrasound_endoscopy")->name("patients.stationary.ultrasound_endoscopy");
    Route::patch("/patients/{patient}/stationary/{stationary}/xray_examination", "StationaryController@xray_examination")->name("patients.stationary.xray_examination");
    Route::patch("/patients/{patient}/stationary/{stationary}/cellular_examination", "StationaryController@cellular_examination")->name("patients.stationary.cellular_examination");
    Route::patch("/patients/{patient}/stationary/{stationary}/expert_advice", "StationaryController@expert_advice")->name("patients.stationary.expert_advice");
    Route::patch("/patients/{patient}/stationary/{stationary}/for_analysis", "StationaryController@for_analysis")->name("patients.stationary.for_analysis");
    Route::patch("/patients/{patient}/stationary/{stationary}/surgery_justification", "StationaryController@surgery_justification")->name("patients.stationary.surgery_justification");
    Route::patch("/patients/{patient}/stationary/{stationary}/surgery_protocol", "StationaryController@surgery_protocol")->name("patients.stationary.surgery_protocol");
    Route::patch("/patients/{patient}/stationary/{stationary}/surgery_description", "StationaryController@surgery_description")->name("patients.stationary.surgery_description");
    Route::patch("/patients/{patient}/stationary/{stationary}/disease_course", "StationaryController@disease_course")->name("patients.stationary.disease_course");
    Route::patch("/patients/{patient}/stationary/{stationary}/resuscitation_department", "StationaryController@resuscitation_department")->name("patients.stationary.resuscitation_department");
    Route::patch("/patients/{patient}/stationary/{stationary}/epicrisis", "StationaryController@epicrisis")->name("patients.stationary.epicrisis");
    Route::patch("/patients/{patient}/stationary/{stationary}/pathological_anatomical", "StationaryController@pathological_anatomical")->name("patients.stationary.pathological_anatomical");
    Route::patch("/patients/{patient}/stationary/{stationary}/treatment_evaluation", "StationaryController@treatment_evaluation")->name("patients.stationary.treatment_evaluation");
    Route::patch("/patients/{patient}/stationary/{stationary}/special_note", "StationaryController@special_note")->name("patients.stationary.special_note");
    Route::patch("/patients/{patient}/stationary/{stationary}/special_note", "StationaryController@special_note")->name("patients.stationary.special_note");

    Route::resource("reception_queues", "Api\QueueController"); // all real, for testing only create-store
    # api testing users
    Route::get('users/{user}/patients/{patient}', 'Api\UserController@patient');
    Route::get('users/{user}/patients', 'Api\UserController@patients');

    Route::resource('calendar', 'Calendar\CalendarController');
    Route::post('calendar/find', 'Calendar\CalendarController@find')->name('calendarfind');
    Route::post('calendar/storeCalendar', 'Calendar\CalendarController@store')->name('calendarstore');
    Route::resource('users', 'UsersController');
    Route::post('users/store_file', 'UsersController@store_file')->name('users.store_file');
    Route::get('users/change/password', 'UsersController@changePssword')->name('users.changeUserPassword');
    Route::post('users/update/password', 'UsersController@updatePssword')->name('users.updateUserPassword');

    Route::group(['prefix' => 'dtssp', 'as' => 'dtssp.'], function () {
        # test-group for server-side dataTables processing
        Route::get('/users', 'UsersController@dtIndex')->name('users.index');
        Route::get('/users_processing', 'UsersController@dtIndexProcessing')->name('users.processing');
    });

    Route::group(["namespace" => "Orders"], function () {
        Route::resource('cashbox/cashboxFirst/orderoutput', 'OrderOutputForCahhboxFirstController', ['as' => 'cashbox.cashboxFirst']);
        Route::resource('cashbox/cashboxSecond/orderoutput', 'OrderOutputForCahhboxSecondController', ['as' => 'cashbox.cashboxSecond']);
        Route::resource('cashbox/cashboxSecond/orderoutput', 'OrderOutputForCahhboxSecondController', ['as' => 'cashbox.cashboxSecond']);
        Route::resource('cashbox/cashboxThirth/orderoutput', 'OrderOutputForCahhboxThirthController', ['as' => 'cashbox.cashboxThirth']);
        Route::resource('cashbox/cashboxFour/orderoutput', 'OrderOutputForCahhboxFourthController', ['as' => 'cashbox.cashboxFour']);

        Route::resource('/cashbox/cashboxFirst/orderinput', 'OrderInputForCahhboxFirstController', ['as' => 'cashbox.cashboxFirst']);
        Route::resource('/cashbox/cashboxSecond/orderinput', 'OrderInputForCahhboxSecondController', ['as' => 'cashbox.cashboxSecond']);
        Route::resource('/cashbox/cashboxThirth/orderinput', 'OrderInputForCahhboxThirtController', ['as' => 'cashbox.cashboxThirth']);
        Route::resource('/cashbox/cashboxFour/orderinput', 'OrderInputForCahhboxFourthController', ['as' => 'cashbox.cashboxFour']);
    });
});
Route::group(['prefix' => 'otherSamples', "namespace" => "OtherSamples", "as" => "otherSamples."], function () {

    Route::resource("parentOtherSamples", "OtherSamplesController");
    Route::resource(
        'ptc',
        'ProcurementTechnicalCharacteristicsController',
        ["except" => ["delete"], 'parameters' => ['procurement_technical_characteristics' => 'ptc']]
    );
    Route::resource(
        "accounting-for-research",
        'AccountingForResearchController',
        ["except" => ["delete"]]
    );

    Route::resource(
        "departments.work-time-bulletins",
        "DepartmentWorkTimeBulletinController"
    );

    Route::resource(
        "users.work-time-bulletins",
        "UserWorkTimeBulletinController"
    );
});


Route::group(['prefix' => 'catalogs', "namespace" => "Catalogs", "as" => "catalogs."], function () {
    Route::get('/harmfuls.json', 'HarmfulController@harmfuls_json');
    Route::get('/medicines.json', 'MedicineListController@medicines_json');
    Route::get('/diseases.json', 'DiseaseListController@diseases_json');
    Route::get('/treatments.json', 'TreatmentListController@treatments_json');
    Route::get('/tumor_treatments.json', 'TumorTreatmentListController@tumor_treatments_json');
    Route::get('/clinics.json', 'ClinicController@clinics_json');
    Route::get('/surgeries.json', 'SurgeryListController@surgeries_json');
    Route::get('/anesthesias.json', 'AnesthesiaListController@anesthesias_json');
    Route::get('/departments.json', 'DepartmentListController@departments_json');
    Route::get('/departments_full.json', 'DepartmentListController@departments_full_json')->name('departments_full');

    Route::get('/chambers.json', 'ChamberListController@chambers_json');
    Route::get('/beds.json', 'BedListController@beds_json');
    Route::get('/lab_service.json', 'LabServiceListController@lab_json');

    Route::get('/samples', 'SampleController@index');
    Route::get('/samples2', 'SampleController@index2');
    Route::get('/samples/target/{target}', 'SampleController@groupByTarget');
    Route::get('/samples/target2/{target}', 'SampleController@groupByTarget2');

    // Route::resource('departments', 'DepartmentListController'); // admin CRUD
    Route::get('/measurement_units.json', 'MeasurementUnitController@measurement_units_json');
    Route::get('/services_full.json/{filterBy?}{needle?}', 'ServiceListController@services_full_json')->name('services_full');

    Route::get('/paid_services_k1.json', 'ServiceListController@paid_services_k1_json')->name('paid_services_k1_json');
    Route::get('/paid_services_k2.json', 'ServiceListController@paid_services_k2_json')->name('paid_services_k2_json');
    Route::get('/paid_services.json', 'ServiceListController@paid_services_json')->name('paid_services_json');
    Route::get('/state_ordered_services.json', 'ServiceListController@state_ordered_services_json')->name('state_ordered_services_json');
    Route::get('/payment_types.json', 'PaymentTypeListController@payment_types_json')->name('payment_types_json');
    Route::get('/payment_types_hy.json', 'PaymentTypeListController@payment_types_hy_json')->name('payment_types_hy_json');

    Route::get('/social_packages.json', 'SocialPackageController@social_packages_json');

    Route::get('/living_place_list.json', 'LivingPlaceListCotroller@living_place_list_json');
    Route::get('/social_living_condition_list.json', 'SocialLivingConditionListCotroller@social_living_condition_list_json');
    Route::get('/working_feature_list.json', 'WorkingFeatureListCotroller@working_feature_list_json');
    Route::get('/education_list.json', 'EducationListCotroller@education_list_json');
    Route::get('/marital_status_list.json', 'MaritalStatusListCotroller@marital_status_list_json');
});

Route::group(['prefix' => 'lists', 'as' => 'lists.'], function () {
    Route::get('/users.json', 'UsersController@users_json');
    Route::get('/doctors.json', 'UsersController@doctors_json');
    Route::get('/users_full.json/{filterBy?}{needle?}', 'UsersController@users_full_json')->name('users_full');
    Route::get('/users_roles.json', 'UsersController@users_roles_json')->name('users_roles');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'departments',
    'as' => 'departments.'
], function () {
    Route::get('structure', 'DepartmentController@structure')->name('structure');
    Route::get('{department}/user/queue', 'DepartmentController@queue')->name('queue');
    Route::get('{department}/queues', 'DepartmentController@queues')->name('queues');
    Route::post('queues/store', 'DepartmentController@queueStore')->name('queues.store');
    Route::post('queues/delete', 'DepartmentController@queueDelete')->name('queues.delete');
    Route::get('/', 'DepartmentController@list')->name('list');

    Route::get('/{department}/users', 'DepartmentController@users')->name('users');
    Route::get('/{department}/users/{user}', 'DepartmentController@user')->name('user');
    Route::get('/{department}/patients', 'DepartmentController@patients')->name('patients');
    Route::get('/{department}/patients/{patient}', 'DepartmentController@patient')->name('patient');
});
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'pharmacy',
    'as' => 'pharmacy.',
    "namespace" => "Pharmacy",
], function () {
    Route::resource('pharmacy', 'PharmacyController');
    Route::get('pharmacy_show-all/{data}', 'PharmacyController@view')->name('pharmacy_show-all');
    Route::post('pharmacy_find', 'PharmacyController@findmedication')->name('findmedication');
    Route::resource('pharmacyEnterHistory', 'PharmacyEnterHistoryController');
    Route::post('pharmacy/Enter/History/{data}', 'PharmacyEnterHistoryController@search')->name('Searchmedication');
    Route::post('pharmacy/upload/file', 'PharmacyController@upload')->name('Uploadmedication');
    Route::post('pharmacy/updateOfMath/', 'PharmacyController@updateofmath')->name('updateofmath');
    Route::post('pharmacy/createOfMath/', 'PharmacyController@createdofmath')->name('createdofmath');
});

Route::group([
    'middleware' => ['auth'],
    'as' => 'wareHouse.',
    "namespace" => "Warehouse",
], function () {
    Route::resource('warehouses', 'WarehouseController');
    Route::get('change/Background', 'UserBackgroundController@background')->name('changeBackground');
});


Route::put("/samples/diagnoses", "Samples\SamplesHasManySectionsController@diagnoses")->name("patients.samples.diagnoses");
Route::post("/samples/delete_diagnoses", "Samples\SamplesHasManySectionsController@delete_diagnoses")->name("patients.samples.delete_diagnoses");

Route::group(["namespace" => "Samples", "prefix" => "samples", "as" => "samples.", "middleware" => "auth"], function () {

    //samples.patients.samples.diagnoses


    Route::resource(
        'patients.uex',
        'UltrasoundEndoscopicExaminationController',
        ["except" => ["delete"], 'parameters' => [
            'ultrasound_endoscopic_examination' => 'uex'
        ]]
    );
    Route::resource('patients.cpcc', 'CancerPatientControlCardController');
    Route::resource(
        'patients.ued',
        'UltrasoundEndoscopicDiagnosisController',
        ["except" => ["delete"], 'parameters' => [
            'ultrasound_endoscopic_diagnosis' => 'ued'
        ]]
    );

    Route::resource(
        'patients.epicrise',
        'EpicriseController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.erythrocyte-morphology',
        'ErythrocyteMorphologyController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.urine_analysis',
        'UrineAnalysisController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.microscopy',
        'MicroscopyController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.blood-transfusion-record-book',
        'BloodTransfusionRecordBookController',
        ["except" => ["delete"]]
    );



    Route::resource('patients.radiation-treatment-card', 'RadiationsCardsTreatmentsController');
    Route::post('patients/radiation-treatment-card/storeRadiationTreatmentPlan/{card_id}', 'RadiationsCardsTreatmentsController@storeRadiationTreatmentPlan')->name('patients.radiation-treatment-card.storeRadiationTreatmentPlan');
    Route::put("patients/radiation-treatment-card/updateRadiationTreatmentPlan{plan_id}", "RadiationsCardsTreatmentsController@updateRadiationTreatmentPlan")->name("patients.radiation-treatment-card.updateRadiationTreatmentPlan");

    Route::post('patients/radiation-treatment-card/storeRadiationTreatmentNotes/{card_id}', 'RadiationsCardsTreatmentsController@storeRadiationTreatmentNotes')->name('patients.radiation-treatment-card.storeRadiationTreatmentNotes');
    Route::put("patients/radiation-treatment-card/updateadiationTreatmentNotes{note_id}", "RadiationsCardsTreatmentsController@updateadiationTreatmentNotes")->name("patients.radiation-treatment-card.updateadiationTreatmentNotes");

    Route::post('patients/radiation-treatment-card/storeRadiationFinalData/{card_id}', 'RadiationsCardsTreatmentsController@storeRadiationFinalData')->name('patients.radiation-treatment-card.storeRadiationFinalData');
    Route::put("patients/radiation-treatment-card/updateRadiationFinalData{final_id}", "RadiationsCardsTreatmentsController@updateRadiationFinalData")->name("patients.radiation-treatment-card.updateRadiationFinalData");

    /*Testend old*/




    Route::resource(
        'patients.assignment_sheet',
        'PrescriptionController',
        ["except" => ["delete"]]
    );
    Route::get('sheet/{data}', 'PrescriptionController@edit')->name('sheetEdit');
    Route::get('sheet/sieorsheetEdit/{data}', 'PrescriptionController@sieorsheetEdit')->name('sieorsheetEdit');
    Route::get('sheet/show/{data}', 'PrescriptionController@show')->name('sheetshow');
    Route::PATCH('sheet/update/{data}', 'PrescriptionController@update')->name('sheetupdate');
    Route::post('sheet/destroy/{data}', 'PrescriptionController@destroy')->name('sheetdestroy');

    Route::PATCH('medication/prescraptions/{data}', 'PrescriptionController@medicationUpdate')->name('medicationUpdate');
    Route::PATCH('medication/prescraptions/delete/{data}', 'PrescriptionController@medicationdelete')->name('medicationDelete');
    Route::post('medication/prescraptions/add/{data}', 'PrescriptionController@medicationAdd')->name('medicationADD');

    Route::PATCH('nomedication/prescraptions/{data}', 'PrescriptionController@nomedicationUpdate')->name('NomedicationUpdate');
    Route::PATCH('nomedication/prescraptions/delete/{data}', 'PrescriptionController@nomedicationDelete')->name('NomedicationDelete');

    Route::resource(
        'patients.hospitalization-referral',
        'HospitalizationReferralController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.reference',
        'ReferenceController',
        ["except" => ["delete"]]
    );

    Route::resource('patients.personal-treatment-plan', 'PersonalTreatmentPlanController', ["except" => ["delete"]]);
    Route::put('patients.personal-treatment-plan-update/{id}', 'PersonalTreatmentPlanController@update')->name('treatment.update');
    Route::get('treatment/trash/medication/{id}', 'PersonalTreatmentPlanController@trash');

    Route::resource(
        'patients.conscious-voluntary-consents',
        'ConsciousVoluntaryConsentController',
        ["except" => ["delete"]]
    );
    // conscious-voluntary-consent

    Route::resource(
        'patients.awareness-sheet',
        'AwarenessSheetController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.cash-entry-order',
        'CashEntryOrderController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.exit-cash-order',
        'ExitCashOrderController',
        ["except" => ["delete"]]
    );


    Route::resource(
        'patients.heat_sheet',
        'HeatSheetController',
        ["except" => ["delete"]]
    );
    Route::resource(
        'heat_sheet.heat_sheet_charts',
        'HeatSheetChartsController'
    );
    /*Route::post('patients/heat_sheet/storeChart/{chart_id}', 'HeatSheetController@storeChart')->name('patients.heat_sheet.storeChart');
    Route::put("patients/heat_sheet/updateChart{chart_id}", "HeatSheetController@updateChart")->name("patients.heat_sheet.updateChart");*/

    Route::resource(
        'patients.surgery-participants',
        'SurgeryParticipantsController'
    );

    Route::resource(
        'patients.referral-outpatient-examinations',
        'ReferralOutpatientExaminationsController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.medical-waste-register',
        'MedicalWasteRegisterController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.bix-sterilization-log',
        'BixSterilizationLogController',
        ["except" => ["delete"]]
    );

    Route::resource('patients.extract','ExtractController',["except" => ["delete"]]);
    Route::get('trash/extract/period/{data}','ExtractController@periodTrash');
    Route::get('trash/extract/period2/{data}','ExtractController@period2Trash');
    Route::get('trash/extract/{data}','ExtractController@treatmentTrash');

    Route::resource(
        'patients.planning-protocol',
        'PlanningProtocolController',
        ["except" => ["delete"]]
    );
    Route::get('planning-protocoltrash/medication/{data}', 'PlanningProtocolController@trash');

    Route::resource(
        'patients.xray-examination-log',
        'XrayExaminationLogController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.patients-management',
        'PatientsManagementController',
        ["except" => ["delete"]]
    );
    Route::PATCH('medicinelists/patients-management/{data}', 'PatientsManagementController@medicinelistsUpdate')->name('patients-management.medicinelistsUpdate');

    Route::resource(
        'patients.clinical-lab-n2',
        'ClinicalLabN2Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.clinical-lab-n11',
        'ClinicalLabN11Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.clinical-lab-n12',
        'ClinicalLabN12Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n1',
        'BiochemicalLabN1Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n2',
        'BiochemicalLabN2Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n3',
        'BiochemicalLabN3Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n4',
        'BiochemicalLabN4Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n5',
        'BiochemicalLabN5Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n7',
        'BiochemicalLabN7Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n8',
        'BiochemicalLabN8Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.biochemical-lab-n9',
        'BiochemicalLabN9Controller',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.inventory-accounting',
        'InventoryAccountingController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.express-pattern',
        'ExpressPaterrnController',
        ["except" => ["delete"]]
    );
    Route::get('patients.expressCretaed/{data}', 'ExpressPaterrnController@create_parent')->name('expresscreate_parent');
    Route::get('patients.expressShow/{data}', 'ExpressPaterrnController@shows')->name('expressShow');
    Route::get('patients.expressEdit/{data}', 'ExpressPaterrnController@edit')->name('expressEdit');
    Route::put('patients.expressUpdate/{data}', 'ExpressPaterrnController@update')->name('expressUpdate');

    Route::resource(
        'patients.lamp-operation-mode',
        'LampOperationModeController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.stationary-inpatient-register', 'StationaryInpatientRegisterController', ["except" => ["delete"]]
    );
    Route::get('stationary/trash/inpatientDiagonstic/{id}', 'StationaryInpatientRegisterController@trash');
    Route::resource(
        'patients.histological-examination',
        'HistologicalExaminationController',
        ["except" => ["delete"]]
    );
    Route::put("/histological-examination/diagnoses", "HistologicalExaminationController@diagnoses")->name("patients.histological-examination.diagnoses");

    Route::resource('patients.iep-n1', 'ImmunologicalExaminationPatternN1Controller', ["except" => ["delete"], 'parameters' => ['immunological_examination_pattern_n1' => 'iep-n1']]);
    Route::get('patients.iepN1.edit/{id}', 'ImmunologicalExaminationPatternN1Controller@edit')->name('iepN1.edit');




    Route::resource(
        'patients.iep-n2',
        'ImmunologicalExaminationPatternN2Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n2' => 'iep-n2'
        ]]
    );

    Route::resource(
        'patients.iep-n3',
        'ImmunologicalExaminationPatternN3Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n3' => 'iep-n3'
        ]]
    );

    Route::resource(
        'patients.iep-n4',
        'ImmunologicalExaminationPatternN4Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n4' => 'iep-n4'
        ]]
    );

    Route::resource(
        'patients.iep-n5',
        'ImmunologicalExaminationPatternN5Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n5' => 'iep-n5'
        ]]
    );

    Route::resource(
        'patients.iep-n7',
        'ImmunologicalExaminationPatternN7Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n7' => 'iep-n7'
        ]]
    );

    Route::resource(
        'patients.iep-n8',
        'ImmunologicalExaminationPatternN8Controller',
        ["except" => ["delete"], 'parameters' => [
            'immunological_examination_pattern_n8' => 'iep-n8'
        ]]
    );


    Route::resource(
        'patients.drug-destruction-act',
        'DrugDestructionActController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.microbiology_examination',
        'MicrobiologyExaminationController'
    );

    Route::resource(
        'patients.microbiology_examination_form_2',
        'MicrobiologyExaminationController_Form_2'
    );

    Route::resource(
        'patients.stationary-discharge-card',
        'StationaryDischargeCardController'
    );
    Route::get(
        'trash/stationaryDiagnostic/{data}',
        'StationaryDischargeCardController@trash'
    );
    Route::resource(
        'patients.advice-sheet-insurance',
        'AdviceSheetInsuranceController'
    );

    Route::resource(
        'patients.sterilization-mode-sister',
        'SterilizationModeSisterController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.inventory-accounting',
        'InventoryAccountingController',
        ["except" => ["delete"]]
    );


    Route::resource(
        'patients.agreement-hospital-room',
        'AgreementHospitalRoomController',
        ["except" => ["delete"]]
    );

    Route::resource(
        'patients.paid-service-contract',
        'PaidServiceContractController',
        ["except" => ["delete"]]
    );
    Route::get('trash/paid-service-contract/{data}', 'PaidServiceContractController@trash');


    Route::resource(
        'patients.medical-care-accounting1',
        'MedicalCareAccounting1Controller',
        ["except" => ["delete"]]
    );
    Route::get('trash/medical-care-accounting1/{data}', 'MedicalCareAccounting1Controller@trash');
    Route::get('trash/medical-care-accounting1/service/{data}', 'MedicalCareAccounting1Controller@labtrash');


    Route::resource(
        'patients.individual-treatment-plan',
        'IndividualTreatmentPlanController'
    );
    Route::get('trash/individual-treatment-plan/{data}', 'IndividualTreatmentPlanController@trash');






    Route::resource('patients.echocardiogram', 'EchocardiogramController');

    Route::resource('patients.ape', 'AnesthesiologistPreSurgeryExaminationController');
    Route::get('trash/anesthesiologist/{data}', 'AnesthesiologistPreSurgeryExaminationController@trash');

    Route::resource('patients.prescription', 'PrescriptionController', ["except" => ["delete"]]);

    Route::resource('patients.advice-sheet', 'AdviceSheetController', ["except" => ["delete"]]);
    Route::resource('patients.sample-diagnosis-delete', 'SamplesController', ["except" => ["delete"]]);
    Route::get('trash/deleteSamplesDiagnosis/{diagnoses_id}', 'SamplesController@deleteSamplesDiagnosis')->name('patients.deleteSamplesDiagnosis');
});

Route::resource('prescription', 'PrescriptionController');

Auth::routes(["register" => false, "reset" => false, "confirm" => false]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', ['middleware' => ['auth']]], function () {
    Route::middleware(['ModeratorPermission'])->group(function () {
        // Route::resource('/', 'IndexController', ['names' => 'admin.home']);
        Route::get('/', function () {
            return redirect('/login');
        });

        Route::resource('roles', 'RolesController', ['names' => 'admin.roles']);
        Route::resource('users', 'UsersController', ['names' => 'admin.users']);
        Route::resource('administrative-staff', 'AdministrativeStaffController', ['names' => 'admin.administrative-staff']);
        Route::get('departments/structure', 'DepartmentController@structure', ['names' => 'admin.departments.structure']);
        Route::resource('departments', 'DepartmentController', ['names' => 'admin.departments']);

        // Route::get("other-samples", 'OtherSamplesController@index')->name('admin.other-samples.index');
        // nonmedical-referrals

        Route::resource('logs', 'LogsController', ['names' => 'admin.logs']);
        Route::resource('treatment-lists', 'TreatmentListsController', ['names' => 'admin.treatment-list']);
        Route::resource('disease-lists', 'DiseaseListsController', ['names' => 'admin.dinisase-list']);
        Route::resource('anesthesia-lists', 'AnesthesiaListsController', ['names' => 'admin.anesthesia-list']);


        Route::resource('payment_cards', 'PaymentTypeController', ['names' => 'admin.payment_card']);


        Route::resource('service-lists', 'ServiceListsController', ['names' => 'admin.service-list']);
        Route::resource('stage-lists', 'StageListsController', ['names' => 'admin.stage-list']);
        Route::resource('tumor-treatment-lists', 'TumorTreatmenListsController', ['names' => 'admin.tumor-treatment-list']);
        Route::resource('surgery-lists', 'SurgeryListsController', ['names' => 'admin.surgery-list']);
        Route::resource('medicine-lists', 'MedicineListController', ['names' => 'admin.medicine-lists']);
        Route::resource('histological-lists', 'HistologicalListsController', ['names' => 'admin.histological-lists']);
        Route::resource('currentStage-lists', 'CurrentStageListsController', ['names' => 'admin.currentStage-lists']);
        Route::resource('exit-lists', 'ExitListsController', ['names' => 'admin.exit-lists']);
        Route::resource('ApplicationPurpose-lists', 'ApplicationPurposeListController', ['names' => 'admin.ApplicationPurpose-lists']);
        Route::resource('Metastasis-lists', 'MetastasisListController', ['names' => 'admin.Metastasis-lists']);
        Route::resource('researches-lists', 'ResearchesListsController', ['names' => 'admin.researches-lists']);
        Route::resource('education-lists', 'EducationListsController', ['names' => 'admin.education-lists']);
        Route::resource('lab-service-lists', 'LabServiceListsController', ['names' => 'admin.lab-service-lists']);
        Route::resource('marital-status-lists', 'MaritalStatusListsController', ['names' => 'admin.marital-status-lists']);
        Route::resource('scholarships-lists', 'ScholarshipsListsController', ['names' => 'admin.scholarships-lists']);
        Route::resource('social-living-condition-lists', 'SocialLivingConditionListsController', ['names' => 'admin.social-living-condition-lists']);
        Route::resource('working-feature-lists', 'WorkingFeatureListsController', ['names' => 'admin.working-feature-lists']);
        Route::resource('age-lists', 'AgeListsController', ['names' => 'admin.age-lists']);

        Route::resource('chamber-lists', 'ChamberListsController', ['names' => 'admin.chamber-lists']);
        Route::resource('bed-lists', 'BedListsController', ['names' => 'admin.bed-lists']);

        Route::resource('health-sample-lists', 'HealthSampleNameController', ['names' => 'admin.health-sample-lists']);
    });
});
Route::get('/', function () {
    // return view('welcome_medex');
    return redirect('/login');
});
