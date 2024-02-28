<?php

use App\Models\Referral;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsSeeder::class); // Բաժանմունքներ Պալատներ Մահճակալներ
        $this->call(UserSeeder::class);
        $this->call(ClinicSeeder::class);
        $this->call(HarmfulSeeder::class);
        $this->call(CancerGroupSeeder::class);

        # START additional patient's data for control-card
        $this->call(MaritalStatusListSeeder::class);
        $this->call(EducationListSeeder::class);
        $this->call(WorkingFeatureListSeeder::class);
        $this->call(SocialLivingConditionListSeeder::class);
        $this->call(LivingPlaceListSeeder::class);
        # END additional patient's data for control-card

        $this->call(PatientSeeder::class);

        $this->call(PatientFirstInfoSeeder::class);
        $this->call(PatientHarmfulSeeder::class);
        $this->call(CancerGroupPatientSeeder::class);

        $this->call(AmbulatorSeeder::class); // Ամբ-քարտ
        $this->call(TnmSeeder::class); // Ամբ-քարտի TNM-ները, սակայն այն պոլիմորֆ-մենի է

        $this->call(AttendaceSeeder::class); // Հաճախումներ
        $this->call(ComplaintSeeder::class); // Գանգատներ

        $this->call(DiseaseListSeeder::class); // հիվանդությունների ցանկ
        $this->call(DiagnosisSeeder::class); // Նախնական-վերջնական ախտ․ (կարելի է ավելացնել նաև - ինչ հիվանդությունով է հիվանդացել)

        $this->call(FemaleIssueSeeder::class); // կանացի խնդիրներ
        $this->call(OnsetAndDevelopmentSeeder::class); // հիվանդության սկիզբը և դրա զարգացումը
        $this->call(TumorInfoSeeder::class); // ուռուցքի նկարագրությունը և նրա տեղակայումը

        $this->call(MedicineTypeSeeder::class); // դեղերի ցուցակ
        $this->call(MedicineListSeeder::class); // դեղերի ցուցակ
        $this->call(MeasurementUnitSeeder::class); // Չափման միավորներ
        $this->call(HealthStatusSeeder::class); // Հիվանդի վիճակ/այցի ամսաթիվ/Նշանակումներ

        $this->call(TreatmentListSeeder::class); // Բուժումների ցուցակ
        $this->call(TumorTreatmentListSeeder::class); // Չարորարակ նորագոյացություններ
        // Բաժանմունքներ Պալատներ Մահճակալներ $this->call(DepartmentsSeeder::class); || UP

        $this->call(StationarySeeder::class); // Ստացիոնար քարտ Ստացիոնար ախտորոշումներ դեղերի անտանելիություններ

        $this->call(AnesthesiaListSeeder::class); // Անզգայացման տեսակներ
        $this->call(SurgeryListSeeder::class); // * Վիրահատությունների ցանկ

        $this->call(StationarySurgerySeeder::class); //* Ստացիոնար քարտի 13-րդ կետ՝ վիրահատություններ
        $this->call(StationaryDisabiltyCertificateSeeder::class); // Անաշխատունակության թերթիկ
        $this->call(StationaryDiseaseOutcomeSeeder::class); // Հիվանդության ելք
        $this->call(StationaryExpertiseConclusionSeeder::class); // Փորձագիտության արդյունքներ
        $this->call(StationaryHistologicalExaminationSeeder::class); // Հյուսվածքաբանական հետազոտություն

        $this->call(StageListSeeder::class); // ստացիոնարի առաջին էջ - Փուլը՝

        $this->call(StationaryPrimaryExaminationSeeder::class); // ստացիոնարի 3-րդ էջ, առաջնային զննում ու իրա relation-ները՝
        $this->call(StationaryPresentStatusSeeder::class); // ստացիոնարի 4-րդ էջ

        $this->call(StationaryUltrasoundEndoscopySeeder::class); // Ուլտրաձայնանյին և էնդոսկոպիկ հետազոտություններ -  7 վերևի մաս

        $this->call(StationarySurgeryJustificationSeeder::class); //* Վիրահատության հիմնավորում - 10
        $this->call(StationarySurgeryProtocolSeeder::class); // * Վիրահատության արձանագրություն - 11

        $this->call(StationarySurgeryDescriptionSeeder::class); // * Վիրահատության նկարագրությունը - 12

        $this->call(StationaryDiseaseCourseSeeder::class); // stationary_disease_course with stationary_prescriptions - 15, 16

        $this->call(StationaryEpicrisisSeeder::class); // stationary_epicrisis 17

        $this->call(StationaryPathologicalAnatomicalSeeder::class); // 18 -ախտաբանա-անատոմիական ախտորոշում
        $this->call(StationarySpecialNoteSeeder::class); // 19 -հատուկ նշումներ
        $this->call(StationaryTreatmentEvaluationSeeder::class); // 20 -բուժման գնահատում ըստ տարբեր սանդղակների

        $this->call(UltrasoundEndoscopicExaminationSeeder::class); // Էնդոսկոպիկ ուլտրաձայնային հետազոտություն

        $this->call(PermissionSeeder::class); // դերերի, լիազորությունների հայտարարում և նշանակում
        $this->call(PatientConnectionSeeder::class); // Կցում ենք հիվանդին այլ բժշկի ու այլ բաժնի

        $this->call(ErythrocyteMorphologySeeder::class); // Էրիթրոցիտների մորֆոլոգիա
        $this->call(BloodTransfusionRecordBookSeeder::class); // Արյան փոխներարկման մատյան

        $this->call(MicroscopySeeder::class); // Միկրոսկոպիա
        $this->call(HospitalizationReferralSeeder::class); // Հոսպիտալացման Ուղեգիր

        $this->call(ReferenceSeeder::class); //ՏԵղեկանք

        $this->call(CashboxesSeeder::class); //ՏԵղեկանք

        $this->call(AwarenessSheetSeeder::class); // Իրազեկման թերթիկ
        $this->call(AnesthesiologistPreSurgeryExaminationSeeder::class); // ԱՆԵՍԹԵԶԻՈԼՈԳԻ ՆԱԽԱՎԻՐԱՀԱՏԱԿԱՆ ԶՆՆՈՒՄ
        $this->call(CorrespondentAccountSeeder::class); // Թղթակցող հաշիվ

        // api
        $this->call(PatientQueueSeeder::class); // api-ի համար հիվանդ և նրա հերթը
        $this->call(DiagnosticAppointementsSeed::class); //Բուժախտորոշիչ նշանակում
        // $this->call(PharmacySeeder::class); //Դեղատուն
        // $this->call(PharmacyEnterHistorySeeder::class); //Դեղատուն Մուտ եկած դեղորայքները
        $this->call(SampesOtherSeeder::class); //Այլ նշանակումներ
        $this->call(HistologicalListsSeeder::class); //Այլ Հյուսվածքաբանական նշումներ
        $this->call(CurrentStageListsSeeder::class); // Ընթացիկ_փուլ
        $this->call(ExitListsSeeder::class); // exit
        $this->call(MetastasisListSeeder::class); // Մետասթազ
        $this->call(ApplicationPurposeListSeeder::class); // Դիմումի նպատակը
        $this->call(ResearchesListsSeeder::class); // Հետազոտություններ
        $this->call(NameMaterialVakueListSeeder::class); // Պահեստ
        $this->call(ScholarshipsListsSeeder::class); //   Պետպատվերի հոդվածը

        $this->call(DepartmentConnectionSeeder::class); // բաժիններ՝ որոնք աշխատակցի համար բաց են:
        $this->call(SocialPackageSeeder::class); // Ստացիենարի համար՝ սոց․ փաթեթների հատուկ խմբեր:

        $this->call(StationarySocialPackageSeeder::class); // s.simonyan Ստացիոնարի սոց․ փաթեթներ - երկու հատ
        $this->call(LabServiceListsSeeder::class); //Կատարված լաբորատոր և գործիքային հետազոտություններ

        $this->call(DepartmentWorkTimeBulletinSeeder::class); // s.simonyan բաժնի աշխատաժամանակի հաշվարկի տեղեկագիր - մեկ հատ
        $this->call(UserWorkTimeBulletinSeeder::class); // s.simonyan բաժնի աշխատաժամանակի հաշվարկի տեղեկագրի լրացում - բաժնի անդամների համար

        $this->call(PaidServiceSeeder::class);
        $this->call(StateOrderedServiceSeeder::class);
        $this->call(PaymentTypeListSeeder::class);

        // $this->call(ServiceListSeeder::class); // Ծառայույունների ցուցակ - հին, խառը ցուցակ
        $this->call(ReferralSeeder::class); // Ուղեգրեր


        $this->call(HealthSampleNamesSeeder::class); // բուժական ձևանմուշների անուն-կարգավորումները (config/samples-ից)

        $this->call(AdministrativeDepartmentsSeeder::class); // (կառուցվածք) Վարչական անձնակազմը, ու նրան ենթարկվող բաժինները

        # control-card START
        $this->call(AgeListSeeder::class); // տարիքային կոդերի ցուցակ իրանց դիապազոնով - հսկիչ քարտի համար
        $this->call(RegistrationOptionListSeeder::class); // Հաշվառման վերցնելու տարբերակները - հսկիչ քարտի համար
        $this->call(MetastaticDiseaseLocationListSeeder::class); // Մետաստատիկ ախտահարման տեղակայում - հսկիչ քարտի համար
        # control-card START

    }
}
