<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->namespace('Api')->group(function () {
    Route::post('patient/login', 'PatientController@login');
    Route::post('patient/register', 'PatientController@register');
    Route::post('patient/enqueue', 'QueueController@store');
    // Route::apiResource('patients', 'PatientController');

    Route::post('user/login', 'UserController@login');
    Route::middleware('auth_token')->group(function () {
        Route::post('users/{user}/patients', 'UserController@patients');
        Route::post('users/{user}/patients/{patient}', 'UserController@patient');
        Route::post('users/calendar', 'CalendarController@finddate');

        # stationary: index + show
        Route::apiResource('patients.stationary', 'StationaryController')->except([
            'store', 'update', 'destroy'
        ]);

        # not working on unity, becouse he can not set header MEDEX-APP-KEY
        # I dublicate these routes to web.php with only  'auth_token' middleware, without 'api'.
        Route::get("/patients/{patients}/stationary/{stationary}/pdf", "StationaryController@get_stationary_pdf")->name('patients.stationary.pdf');
        Route::get("/patients/{patients}/ambulator/{ambulator}/pdf", "AmbulatorController@get_ambulator_pdf")->name('patients.ambulator.pdf');

        # ambulator: index + show
        Route::apiResource('patients.ambulator', 'AmbulatorController')->except([
            'store', 'update', 'destroy'
        ]);
        Route::get("samples/patients/{patients}/iep-n1", "Samples\Index\ImmunologicalExaminationPatternController@get_im1");
        Route::get("samples/patients/{patients}/iep-n3", "Samples\Index\ImmunologicalExaminationPatternController@get_im3");
        Route::get("samples/patients/{patients}/iep-n4", "Samples\Index\ImmunologicalExaminationPatternController@get_im4");
        Route::get("samples/patients/{patients}/iep-n5", "Samples\Index\ImmunologicalExaminationPatternController@get_im5");
        Route::get("samples/patients/{patients}/iep-n7", "Samples\Index\ImmunologicalExaminationPatternController@get_im7");
        Route::get("samples/patients/{patients}/iep-n8", "Samples\Index\ImmunologicalExaminationPatternController@get_im8");
        Route::get("samples/patients/{patients}/erythrocyte-morphology", "Samples\Index\ErythrocyteMorphologyController@index");
        Route::get("samples/patients/{patients}/uex", "Samples\Index\UltrasoundEndoscopicExaminationController@index");
        Route::get("samples/patients/{patients}/ape", "Samples\Index\AnesthesiologistPreSurgeryExaminationController@index");
        Route::get("samples/patients/{patients}/radiation-treatment-card", "Samples\Index\RadiationsCardsTreatmentsController@index");
        Route::get("samples/patients/{patients}/bix-sterilization-log", "Samples\Index\BixSterilizationLogController@index");
        Route::get("samples/patients/{patients}/conscious-voluntary-consents", "Samples\Index\ConsciousVoluntaryConsentController@index");
        Route::get("samples/patients/{patients}/echocardiogram", "Samples\Index\EchocardiogramController@index");
        Route::get("samples/patients/{patients}/biochemical-lab-n1", "Samples\Index\BiochemicalLabController@get_1_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n2", "Samples\Index\BiochemicalLabController@get_2_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n3", "Samples\Index\BiochemicalLabController@get_3_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n4", "Samples\Index\BiochemicalLabController@get_4_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n5", "Samples\Index\BiochemicalLabController@get_5_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n7", "Samples\Index\BiochemicalLabController@get_7_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n8", "Samples\Index\BiochemicalLabController@get_8_pdf");
        Route::get("samples/patients/{patients}/biochemical-lab-n9", "Samples\Index\BiochemicalLabController@get_9_pdf");
        Route::get("samples/patients/{patients}/histological-examination", "Samples\Index\HistologicalExaminationController@index");
        Route::get("samples/patients/{patients}/express-pattern", "Samples\Index\ExpressPaterrnController@index");
        Route::get("samples/patients/{patients}/personal-treatment-plan", "Samples\Index\PersonalTreatmentPlanController@index");
        Route::get("samples/patients/{patients}/lamp-operation-mode", "Samples\Index\LampOperationModeController@index");
        Route::get("samples/patients/{patients}/planning-protocol", "Samples\Index\PlanningProtocolController@index");
        Route::get("samples/patients/{patients}/medical-waste-register", "Samples\Index\MedicalWasteRegisterController@index");
        Route::get("samples/patients/{patients}/clinical-lab-n2", "Samples\Index\ClinicalLabController@get_index_n2");
        Route::get("samples/patients/{patients}/clinical-lab-n11", "Samples\Index\ClinicalLabController@get_index_n11");
        Route::get("samples/patients/{patients}/clinical-lab-n12", "Samples\Index\ClinicalLabController@get_index_n12");
        Route::get("samples/patients/{patients}/stationary-inpatient-register", "Samples\Index\StationaryInpatientRegisterController@index");
        Route::get("samples/patients/{patients}/drug-destruction-act", "Samples\Index\DrugDestructionActController@index");

        Route::get("samples/patients/{patients}/microbiology_examination", "Samples\Index\MicrobiologyExaminationController@index");
        Route::get("samples/patients/{patients}/microbiology_examination_form_2", "Samples\Index\MicrobiologyExaminationController_Form_2@index");
        Route::get("samples/patients/{patients}/advice-sheet", "Samples\Index\AdviceSheetController@index");
        Route::get("samples/patients/{patients}/advice-sheet-insurance", "Samples\Index\AdviceSheetInsuranceController@index");
        Route::get("samples/patients/{patients}/surgery-participants", "Samples\Index\SurgeryParticipantsController@index");
        Route::get("samples/patients/{patients}/xray-examination-log", "Samples\Index\XrayExaminationLogController@index");
        Route::get("samples/patients/{patients}/sterilization-mode-sister", "Samples\Index\SterilizationModeSisterController@index");
        Route::get("samples/patients/{patients}/agreement-hospital-room", "Samples\Index\AgreementHospitalRoomController@index");
        Route::get("samples/patients/{patients}/paid-service-contract", "Samples\Index\PaidServiceContractController@index");
        Route::get("samples/patients/{patients}/heat_sheet", "Samples\Index\HeatSheetController@index");
        Route::get("samples/patients/{patients}/individual-treatment-plan", "Samples\Index\IndividualTreatmentPlanController@index");
        Route::get("samples/patients/{patients}/patients-management", "Samples\Index\PatientsManagementController@index");
        Route::get("samples/patients/{patients}/medical-care-accounting1", "Samples\Index\MedicalCareAccounting1Controller@index");
        Route::get("samples/patients/{patients}/assignment_sheet", "Samples\Index\PrescriptionController@index");

        Route::get("samples/patients/{patients}/extract", "Samples\Index\ExtractController@index");




        //Referals
        Route::get("/referrals/patients/services", "ReferralController@servicesIndex")->name("api.referrals.patients.services");
        Route::get("/referrals/patients/received", "ReferralController@receivedIndex")->name("referrals.patients.received");
        Route::get("/referrals/patients/received/assigned", "ReferralController@receivedAssigned")->name("referrals.patients.received.assigned");
        Route::get("/referrals/patients/received/not_assigned", "ReferralController@receivedNotAssigned")->name("referrals.patients.received.not_assigned");
        Route::get("/referrals/patients/received/{referral_id}/{user_id}", "ReferralController@show")->name("referrals.patients.received.show");

        Route::get("/referrals/patients/sentShow", "ReferralController@sentShow")->name("referrals.patients.sent.show");
        Route::get("/referrals/patients/sent", "ReferralController@sentIndex")->name("referrals.patients.sent");
        Route::get("/referrals/patients/sent_others", "ReferralController@sentOthers")->name("referrals.patients.sent_others");

    });
});
