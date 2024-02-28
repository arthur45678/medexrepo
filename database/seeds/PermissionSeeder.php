<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        # ---------------- #
        # create permissions
        // 1. permissions to work with patients
        Permission::create(['name' => 'view all-patients']);
        Permission::create(['name' => 'view patients']);
        Permission::create(['name' => 'create patients']);
        Permission::create(['name' => 'update patients']);
        Permission::create(['name' => 'delete patients']);
        // Permission::create(['name' => 'restore patients']);
        // Permission::create(['name' => 'forceDelete patients']);

        // 2. permissions to work with ambulators (ամբուլատոր քարտ)
        Permission::create(['name' => 'view ambulators']);
        Permission::create(['name' => 'create ambulators']);
        Permission::create(['name' => 'update ambulators']);
        Permission::create(['name' => 'delete ambulators']);

        // 3. permissions to work with stationaries (ստացիոնար քարտ)
        Permission::create(['name' => 'view stationaries']);
        Permission::create(['name' => 'create stationaries']);
        Permission::create(['name' => 'update stationaries']);
        Permission::create(['name' => 'delete stationaries']);


        // 4. permissions to work with users (հիվանդանոցի աշխատողներ)
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // x. permission to add patient to queue
        Permission::create(['name' => 'add patient to queue']);

        // x. permissions to work with procurement (գնումներ)
        Permission::create(['name' => 'view procurement']);
        Permission::create(['name' => 'create procurement']);
        Permission::create(['name' => 'update procurement']);
        Permission::create(['name' => 'delete procurement']);

        // x. permissions to work with warehouse-items (պահեստի ապրանքներ)
        Permission::create(['name' => 'view warehouse-items']);
        Permission::create(['name' => 'role warehouse-items']);
        Permission::create(['name' => 'update warehouse-items']);
        Permission::create(['name' => 'delete warehouse-items']);

        // x. permissions to work with medicines (Դեղորայքի մնացորդ)
        Permission::create(['name' => 'view medicines']);
        Permission::create(['name' => 'create medicines']);
        Permission::create(['name' => 'update medicines']);
        Permission::create(['name' => 'delete medicines']);
        Permission::create(['name' => 'search medicines']);

        // x. permissions to work with cashboxes (դրամարկղեր)
        Permission::create(['name' => 'view cashboxes']);
        Permission::create(['name' => 'create cashboxes']);
        Permission::create(['name' => 'update cashboxes']);
        Permission::create(['name' => 'delete cashboxes']);

        // x. permissions to work with cashboxes (դրամարկղ 1)
        Permission::create(['name' => 'view cashboxes 1']);
        Permission::create(['name' => 'update cashboxes 1']);
        Permission::create(['name' => 'delete cashboxes 1']);

        // x. permissions to work with cashboxes (դրամարկղ 2)
        Permission::create(['name' => 'view cashboxes 2']);
        Permission::create(['name' => 'update cashboxes 2']);
        Permission::create(['name' => 'delete cashboxes 2']);

        // x. permissions to work with cashboxes (դրամարկղ 3)
        Permission::create(['name' => 'view cashboxes 3']);
        Permission::create(['name' => 'update cashboxes 3']);
        Permission::create(['name' => 'delete cashboxes 3']);

        // x. permissions to work with cashboxes (դրամարկղ 4)
        Permission::create(['name' => 'view cashboxes 4']);
        Permission::create(['name' => 'update cashboxes 4']);
        Permission::create(['name' => 'delete cashboxes 4']);


        // x. permissions to work with samples (ձևանմուշներ)
        Permission::create(['name' => 'view samples']);
        Permission::create(['name' => 'create samples']);
        Permission::create(['name' => 'update samples']);
        Permission::create(['name' => 'delete samples']);

        // x. permissions to work with reports (հաշվետվություններ)
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'create reports']);
        Permission::create(['name' => 'update reports']);
        Permission::create(['name' => 'delete reports']);

        // x. permissions to work with archives (արխիվներ)
        Permission::create(['name' => 'view archives']);
        Permission::create(['name' => 'create archives']);
        Permission::create(['name' => 'update archives']);
        Permission::create(['name' => 'delete archives']);

        // x. permissions to work with departments (բաժիններ)
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);


        // x. permissions to work with roles (ռոլեր)
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        # --------------------------------------------------- #
        # create roles and assign existing permissions to roles
        // reception roles-permissions
        $receptionist = Role::create(['name' => 'receptionist']);
        $receptionist->givePermissionTo('view all-patients');
        $receptionist->givePermissionTo('view patients');
        $receptionist->givePermissionTo('create patients');
        $receptionist->givePermissionTo('update patients');
        $receptionist->givePermissionTo('delete patients');

        $receptionist->givePermissionTo('create ambulators');
        $receptionist->givePermissionTo('create stationaries');

        // medical roles-permissions
        $doctor = Role::create(['name' => 'doctor']);
        $doctor->givePermissionTo('view patients');
        $doctor->givePermissionTo('create patients');
        $doctor->givePermissionTo('update patients');
        $doctor->givePermissionTo('view medicines');

        $department_head = Role::create(['name' => 'department_head']);
        $department_head->givePermissionTo('view patients');
        $department_head->givePermissionTo('add patient to queue');
        $department_head->givePermissionTo('view medicines');

        $department_registrar = Role::create(['name' => 'department_registrar']);
        $department_registrar->givePermissionTo('view patients');
        $department_registrar->givePermissionTo('add patient to queue');

        $head_nurse = Role::create(['name' => 'head_nurse']);
        $head_nurse->givePermissionTo('view patients');
        $head_nurse->givePermissionTo('view medicines');

        $nurse = Role::create(['name' => 'nurse']);
        $nurse->givePermissionTo('view patients');

        // not medical departments, roles-permissions
        # ------ Administrative staff roles-permissions (Վարչական անձնակազմ)
        // տնօրեն
        $director = Role::create(['name' => 'director']);
        $director->givePermissionTo('view patients');
        $director->givePermissionTo('view users');
        $director->givePermissionTo('view warehouse-items');
        $director->givePermissionTo('view reports');
        $director->givePermissionTo('view medicines');
        $director->givePermissionTo('search medicines');
        $director->givePermissionTo('view archives');

        $director->givePermissionTo(['view cashboxes 1','update cashboxes 1','delete cashboxes 1',
            'view cashboxes 2','update cashboxes 2','delete cashboxes 2',
            'view cashboxes 3','update cashboxes 3','delete cashboxes 3',
            'view cashboxes 4','update cashboxes 4','delete cashboxes 4',]);

        // Տնօրենի տեղակալ ֆինանսատնտեսական գծով
        // Վերահսկում է գնումների, հաշվապահության, ինժիներական խմբի, տնտեսկան, կադրային, իրավաբանական բաժինների աշխատանքը
        $finance_and_economics_deputy_director = Role::create(
            ['name' => 'finance_and_economics_deputy_director']
        );
        $finance_and_economics_deputy_director->givePermissionTo('view procurement');
        $finance_and_economics_deputy_director->givePermissionTo('view medicines');
        $finance_and_economics_deputy_director->givePermissionTo('search medicines');

        // Տնօրենի տեղակալ բուժական գծով
        // Վերահսկում է կլինիկական բաժանմունքների աշխատանքը
        $medical_affairs_deputy_director = Role::create(
            ['name' => 'medical_affairs_deputy_director']
        );
        $medical_affairs_deputy_director->givePermissionTo('view patients');

        // Տնօրենի տեղակալ ամբուլատոր-դիսպանսեր հսկողության և ընդունարանի գծով
        // սա նույն գլխավոր բժիշկն է:
        // Վերահսկում է ամբուլատոր հսկողության բաժանմունքը, ընդունարանը և արխիվը
        $outpatient_dispensary_and_reception_deputy_director = Role::create(
            ['name' => 'outpatient_dispensary_and_reception_deputy_director']
        );
        $outpatient_dispensary_and_reception_deputy_director->givePermissionTo('view patients');
        // $chief_doctor = Role::create(['name' => 'chief_doctor']);
        // $chief_doctor->givePermissionTo('view patients');

        // Տնօրենի տեղակալ լաբորատոր-ախտորոշիչ ծառայությունների, միջին ու կրտսեր բուժ անձնակազմի գծով
        // Վերահսկում է լաբորատոր-ախտորոշիչ ծառայությունները, միջին և կրտսեր բուժ անձնակազմը, ներհիվանդանոցային և հանրապետական վիճակագրական խմբերը։
        $laboratory_diagnostic_services_secondary_and_junior_medical_staff_deputy_director = Role::create(
            ['name' => 'laboratory_diagnostic_services_secondary_and_junior_medical_staff_deputy_director']
        );

        // Տնօրենի խորհրդական վերահակողության,պլանավորման և ֆինանսների գծով - էլ չկա սա:

        // Գլխավոր հաշվապահ
        // Վերահսկում է հաշվապահության բոլոր աշխատակիցներին, դրամարկղ, պահեստի ապրանքներ
        $chief_accountant = Role::create(['name' => 'chief_accountant']);
        $chief_accountant->givePermissionTo('view cashboxes');
        $chief_accountant->givePermissionTo('view warehouse-items');
        $chief_accountant->givePermissionTo('view medicines');
        $chief_accountant->givePermissionTo('search medicines');

        // Քաղպաշտպանության շտաբի պետ
        $civil_defense_headquarters_chief = Role::create(['name' => 'civil_defense_headquarters_chief']);

        // Իրավաբան
        $lawyer = Role::create(['name' => 'lawyer']);

        // Կադրերի բաժնի վարիչ
        $human_resources_head = Role::create(['name' => 'human_resources_head']);
        $human_resources_head->givePermissionTo('view users');

        // Տնօրենի օգնական
        $director_assistant = Role::create(['name' => 'director_assistant']);

        // մոդերատոր
        $moderator = Role::create(['name' => 'moderator']);

        $super_admin = Role::create(['name' => 'super_admin']);
        $super_admin->givePermissionTo(Permission::all());

        # ------ Accounting - Հաշվապահություն
        // Տնտեսագետ
        $economist = Role::create(['name' => 'economist']);

        // Ավագ հաշվապահ
        $senior_accountant = Role::create(['name' => 'senior_accountant']);

        // Հաշվապահ
        $accountant = Role::create(['name' => 'accountant']);

        // Կրտսեր հաշվապահ
        $junior_accountant = Role::create(['name' => 'junior_accountant']);

        // Գանձապահ
        $casier = Role::create(['name' => 'casier']);

        // Ֆինանսական վերլուծաբան
        $financial_analyst =  Role::create(['name' => 'financial_analyst']);

        # ------ Human resources department - Կադրերի բաժին
        // Մարդկային ռեսուրսների մասնագետ
        $human_resources_specialist = Role::create(['name' => 'human_resources_specialist']);

        // Համակարգչային օպերատոր
        $human_resources_computer_operator = Role::create(['name' => 'human_resources_computer_operator']);

        // Հասարակության հետ կապերի համակարգող
        $public_relations_coordinator = Role::create(['name' => 'public_relations_coordinator']);

        # ------ Procurement Department - Գնումների բաժին
        // գնումների համակարգող
        $procurement_coordinator = Role::create(['name' => 'procurement_coordinator']);

        // գնումների օպերատոր
        $procurement_operator = Role::create(['name' => 'procurement_operator']);

        # ------ Engineering group - Ինժեներական խումբ
        // Ինժեներական խմբի ղեկավար
        $head_of_engineering_group = Role::create(['name' => 'head_of_engineering_group']);

        // Ցանցային ադմինիստրատոր
        $network_administrator = Role::create(['name' => 'network_administrator']);

        # ------ Economic service - Տնտեսական ծառայություն
        // Տնտեսական ծառայության պետ
        $head_of_economic_service = Role::create(['name' => 'head_of_economic_service']);

        // Պահեստապետ
        $storekeeper = Role::create(['name' => 'storekeeper']);

        # ------ Pharmacy - Դեղատուն
        // Դեղատան վարիչ
        $head_of_pharmacy = Role::create(['name' => 'head_of_pharmacy']);

        // Պրովիզոր
        $pharmacist = Role::create(['name' => 'pharmacist']);

        # ------ In-hospital statistical group Ներհիվանդանոցային վիճակագրական խումբ
        // Խմբի ղեկավար
        $inhospital_statistical_group_leader = Role::create(['name' => 'group_leader']);

        // Բժիշկ - վիճակագիր
        $inhospital_statistical_doctor = Role::create(['name' => 'inhospital_statistical_doctor']);

        // Համակարգչային օպերատոր
        $inhospital_statistical_operator = Role::create(['name' => 'inhospital_statistical_operator']);


        # ------ Republican Oncology Statistical Group - Հանրապետական ուռուցքաբանության վիճակագրական խումբ
        $republican_statistical_group_leader = Role::create(['name' => 'republican_statistical_group_leader']);

        // Բժիշկ - վիճակագիր
        $republican_statistical_doctor = Role::create(['name' => 'republican_statistical_doctor']);

        // Համակարգչային օպերատոր
        $republican_statistical_operator = Role::create(['name' => 'republican_statistical_operator']);

        # ------ Archive - Արխիվ
        // Արխիվի վարիչ
        $archive_manager = Role::create(['name' => 'archive_manager']);

        # ------ Outpatient dispensary control department and reception - Ամբուլատոր-դիսպանսեր հսկողության բաժանմունք և ընդունարան
        // բուժ. մատենավար
        $medical_clerk = Role::create(['name' => 'medical_clerk']);

        // Համակարգչային օպերատոր
        $outpatient_operator = Role::create(['name' => 'outpatient_operator']);

        // Տեղեկատու օպերատոր
        $outpatient_informative_operator = Role::create(['name' => 'outpatient_informative_operator']);

        # ------ General hospital staff - Ընդհանուր հիվանդանոցային անձնակազմ
        // Հոգեբան
        $psychologist = Role::create(['name' => 'psychologist']);

        // Բժիշկ սրտաբան
        $cardiologist = Role::create(['name' => 'cardiologist']);

        // Համաճարակաբան
        $epidemiologist = Role::create(['name' => 'epidemiologist']);

        // Սոցիալական աշխատող
        $social_worker =  Role::create(['name' => 'social_worker']);


        # ----- Diagnostic service - Ախտորոշման ծառայություն
        // Ախտորոշման ծառայության ղեկավար
        $diagnostic_service_head = Role::create(['name' => 'diagnostic_service_head']);

        // Ախտորոշման ծառայության ղեկավարի տեղակալ
        $diagnostic_service_deputy_head = Role::create(['name' => 'diagnostic_service_deputy_head']);

        // Բուժքույր ադմինիստրատոր
        $nurse_administrator = Role::create(['name' => 'nurse_administrator']);


        // ================= questions ==================== //
        // Ընդհանուր ու մանկական ուռուցքաբանության և ռեկոնստրուկտիվ վիրաբուժության բաժանմունք - ԼՈՐ ուռուցքաբանության ծառայության ղեկավար
        // Ընդհանուր և մանկական քիմիաթերապիայի բաժանմունք - Մենեջեր
        // Կլինիկական -պաթոմորֆոլոգիայի բաժանմունք - Մենեջեր


        // Հաշվապահ, որը կարողա սպասարկել 1 դրամարկղը
        $accountant_1 = Role::create(['name' => 'accountant_1']);
        $accountant_1->givePermissionTo(['view cashboxes 1','update cashboxes 1','delete cashboxes 1',]);

        // Հաշվապահ, որը կարողա սպասարկել 2 դրամարկղը
        $accountant_2 = Role::create(['name' => 'accountant_2']);
        $accountant_2->givePermissionTo(['view cashboxes 2','update cashboxes 2','delete cashboxes 2',]);

        // Հաշվապահ, որը կարողա սպասարկել 3 դրամարկղը
        $accountant_3 = Role::create(['name' => 'accountant_3']);
        $accountant_3->givePermissionTo(['view cashboxes 3','update cashboxes 3','delete cashboxes 3',]);
        // Հաշվապահ, որը կարողա սպասարկել 4 դրամարկղը

        $accountant_4 = Role::create(['name' => 'accountant_4']);
        $accountant_4->givePermissionTo(['view cashboxes 4','update cashboxes 4','delete cashboxes 4',]);

        # -------------------------------- #
        # assigning roles to user/department
        // medical users-roles
        $user_simon = User::where('username', 's.simonyan')->first();
        $user_simon->assignRole([$doctor]);

        $user_makar = User::where('username', 'm.makaryan')->first();
        // $user_makar->givePermissionTo(['update patients']);
        $user_makar->assignRole([$doctor]);

        # Ընդունարան
        // Համակարգչային օպերատոր - araqsya.poghosyan
        $user_receptionist = User::where('username', 'araqsya.poghosyan')->first();
        $user_receptionist->assignRole($receptionist);

        # Որովայնային և էնդովիրաբուժական բաժանմունք (department_id = 1)
        // Բաժանմունքի վարիչ - armen.nikoghosyan
        $user_abdominal_department_head = User::where('username', 'armen.nikoghosyan')->first();
        $user_abdominal_department_head->assignRole($department_head);

        // Բժիշկ -ուռուցքաբան 1 - Hmayak.epremyan
        $user_abdominal_doctor_1 = User::where('username', 'Hmayak.epremyan')->first();
        $user_abdominal_doctor_1->assignRole($doctor);

        // Բժիշկ -ուռուցքաբան 2 - tigran.poghosyan
        $user_abdominal_doctor_2 = User::where('username', 'tigran.poghosyan')->first();
        $user_abdominal_doctor_2->assignRole($doctor);

        // Ավագ բուժքույր - nona.vardanyan
        $user_abdominal_head_nurse = User::where('username', 'nona.vardanyan')->first();
        $user_abdominal_head_nurse->assignRole($head_nurse);


        # Մամոլոգիական բաժանմունք  (department_id = 2)
        // Բաժանմունքի վարիչ - Andrey.minasyants
        $user_mammological_department_head = User::where('username', 'Andrey.minasyants')->first();
        $user_mammological_department_head->assignRole($department_head);

        // Բժիշկ ուռուցքաբան 1 - irina.khachatryan
        $user_mammological_doctor_1 =  User::where('username', 'irina.khachatryan')->first();
        $user_mammological_doctor_1->assignRole($doctor);

        // Բժիշկ ուռուցքաբան 2 - hamlet.davtyan
        $user_mammological_doctor_2 =  User::where('username', 'hamlet.davtyan')->first();
        $user_mammological_doctor_2->assignRole($doctor);

        // Ավագ բուժքույր -marieta.baghdasaryan
        $user_mammological_head_nurse = User::where('username', 'marieta.baghdasaryan')->first();
        $user_mammological_head_nurse->assignRole($head_nurse);

        // Տնօրեն - narek.manukyan
        $user_director = User::where('username', 'narek.manukyan')->first();
        $user_director->assignRole($director);

        // մոդերատոր - arevik.stepanyan
        $user_moderator = User::where('username', 'arevik.stepanyan')->first();
        $user_moderator->assignRole([$moderator]);

        // Տնօրենի տեղակալ բուժական գծով
        $user_medical_affairs_deputy_director = User::where('username', 'aram.jilavyan')->first();
        $user_medical_affairs_deputy_director->assignRole([$medical_affairs_deputy_director]);

        // Տնօրենի տեղակալ ամբուլատոր-դիսպանսեր հսկողության և ընդունարանի գծով
        $user_outpatient_dispensary_and_reception_deputy_director = User::where('username', 'gagik.bazikyan')->first();
        $user_outpatient_dispensary_and_reception_deputy_director->assignRole([$outpatient_dispensary_and_reception_deputy_director]);


        // Բաժանմունքներ
        Permission::create(['name' => 'dep_Vorovaynayin_yev_Endovirabuzhakan']);
        Permission::create(['name' => 'dep_Mamologia_N1']);
        Permission::create(['name' => 'dep_virahatakan_bajanmunq']);
        Permission::create(['name' => 'dep_Anzgayutyun_yev_verakendanecum']);
        Permission::create(['name' => 'dep_Neyrivirabujutyun']);
        Permission::create(['name' => 'dep_@ndhanur_urucqabanutyun:']);
        Permission::create(['name' => 'dep_Voskrayin_bazhanmunk’']);
        Permission::create(['name' => 'dep_Voskrayin_bajanmunq']);
        Permission::create(['name' => 'dep_Urologiakan_bajanmunq']);
        Permission::create(['name' => 'dep_Oncologia_N_1']);
        Permission::create(['name' => 'dep_Torakal_virabujutyan_bajanmunq']);
        Permission::create(['name' => 'dep_@nkerutyan_kentronakan_pahest']);
        Permission::create(['name' => 'dep_Charagaytayin baj']);
        Permission::create(['name' => 'dep_Radioginecologia']);
        Permission::create(['name' => 'dep_Endoscopia']);
        Permission::create(['name' => 'dep_Rentgen axtoroshum']);
        Permission::create(['name' => 'dep_Patomorfologia']);
        Permission::create(['name' => 'dep_Klinikakan kensaqimiakan labaratoria']);
        Permission::create(['name' => 'dep_Bakterologiakan_laboratoria']);
        Permission::create(['name' => 'dep_Avtoklav']);
        Permission::create(['name' => 'dep_EKG kabinet']);
        Permission::create(['name' => 'dep_Policlinica']);
        Permission::create(['name' => 'dep_Varchakan andznakazm']);
        Permission::create(['name' => 'dep_Donorakan_ket']);
        Permission::create(['name' => 'dep_Immunabanutyan laboratoria']);
        Permission::create(['name' => 'dep_Dexatun']);
        Permission::create(['name' => 'dep_Hamalir axtoroshum']);
        Permission::create(['name' => 'dep_Himnakan_mijocner']);
        Permission::create(['name' => 'dep_Kardiolog']);
        Permission::create(['name' => 'dep_Epidemilog']);
        Permission::create(['name' => 'dep_Paliativ carayutyun']);
        Permission::create(['name' => 'dep_Ambulator dispanser hskoxutyan bajanmunq']);
        Permission::create(['name' => 'dep_Izotop']);
        Permission::create(['name' => 'dep_Glxavor bujquyr']);
        Permission::create(['name' => 'dep_@ndhanur mankakan qimiaterapia']);
        Permission::create(['name' => 'dep_Mankakan yev @ndhanur urucqabanutyun']);
        Permission::create(['name' => 'dep_Hamalir yev rentgen axtoroshman bajin']);
        Permission::create(['name' => 'dep_Kananc aroxjapahutyan klinika']);
        Permission::create(['name' => 'dep_Donorakan aryan ket']);
        Permission::create(['name' => 'dep_Anhatuyc stacac bjshkakan paraga']);
        Permission::create(['name' => 'dep_Tntesakan carayutyun']);
        Permission::create(['name' => 'dep_Kadreri bajin']);
        Permission::create(['name' => 'dep_Nerhivandanocayin vich. xumb']);
        Permission::create(['name' => 'dep_Hanrapetakan vich.']);
        Permission::create(['name' => 'dep_Xumb']);
        Permission::create(['name' => 'dep_Arxiv']);
        Permission::create(['name' => 'dep_@ndhanur hiv. andznakazm']);
        Permission::create(['name' => 'dep_Finansakan bajanmunq']);
        Permission::create(['name' => 'dep_Gnumneri bajin']);
        Permission::create(['name' => 'dep_Klinika-kensaqim immunalab laboratoria']);
        Permission::create(['name' => 'dep_Axtoroshman carayutyun']);
        Permission::create(['name' => 'dep_Axtoroshich carayutyun']);

    }
}


