<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    private $departmentss = " Որովայնային և էնդովիրաբուժական բաժանմունք 60 մահճակալ
    Մամոլոգիական բաժանմունք – 30 մահճակալ
    Օնկոգինեկոլոգիական բաժանմունք – 30 մահճակալ
    Օնկոուրոլոգիական բաժանմունք – 30 մահճակալ
    Նեյրոօնկոլոգիական բաժանմունք – 30 մահճակալ
    Ոսկրային ուռուցքաբանության բաժանմունք – 30 մահճակալ
    Ընդհանուր և մանկական ուռուցքաբանության բաժանմունք – 40 մահճակալ
    Ճառագայթային ուռուցքաբանության բաժանմունք – 35 մահճակալ
    Ռադիոգինեկոլոգիական բաժանմունք – 35 մահճակալ
    Ընդհանուր և մանկական քիմիաթերապիայի բաժանմունք – 80 մահճակալ
    Թորակալ վիրաբուժության բաժանմունք – 30 մահճակալ
    Կանանց առողջության կլինիկա – 30 մահճակալ";

    private $departments = [
        // start medical departments -->

//        ['id'=> 1,
//            "code"=>'45',
//            "name" => "Որովայնային և Էնդովիրաբուժական", "closed_from_outside" => false,
//            "closed_from_inside" => false,
//            "has_bads" => false
//        ],
//        ['id'=> 2, "code"=>'11', "name" => "Մամոլոգիա N1", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 3, "code"=>'07', "name" => "Վիրահատական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 4, "code"=>'08', "name" => "Անզգայացում և վերակենդանացում", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 5, "code"=>'09', "name" => "Նեյրովիրաբուժություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 6, "code"=>'14', "name" => "Ոսկրային  բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 7, "code"=>'15', "name" => "ՈՒռոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 8, "code"=>'16', "name" => "Օնկոգինոկոլոգիա N1", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 9, "code"=>'19', "name" => "Թորակալ վիրաբուժության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 10, "code"=>'23', "name" => "Ճառագայթային բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 11, "code"=>'24', "name" => "Ռադիոգինեկոլոգիա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 12, "code"=>'27', "name" => "Պաթոմորֆոլոգիա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 13, "code"=>'28', "name" => "Կլինիկական և Կենսաքիմիական  լաբ.", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 14, "code"=>'30', "name" => "Ավտոկլավ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 15, "code"=>'36', "name" => "Դեղատուն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 16, "code"=>'64', "name" => "Ընդհանուր և մանկական քիմիաթերապիա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 17, "code"=>'65',"name" => "Մանկական և Ընդհանուր  Ուռուցքաբանություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 18, "code"=>'66', "name" => "Համալիր և Ռենտգեն ախտորոշման բաժին", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 19, "code"=>'67', "name" => "Ամբուլատոր-դիսպանսեր հսկողության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 20, "code"=>'68', "name" => "Կանանց առողջության կլինիկա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 21, "code"=>'84', "name" => "Ախտորոշիչ ծառայություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 22, "code"=>'0', "name" => "Վարչական անձնակազմ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ['id'=> 32, "code"=>'0', "name" => "Ամբուլատոր-դիսպանսեր հսկողության բաժանմունք և ընդունարան", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],

//        ["name" => "Որովայնային և էնդովիրաբուժական բաժանմունք", "closed_from_outside" => true, "closed_from_inside" => false, "has_bads" => true], // test-send-patient
//        ["code"=>11,"name" => "Մամոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => true, "has_bads" => true], // test-send-patient
//        ["code"=>1,"name" => "Օնկոգինեկոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Օնկոուրոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Նեյրոօնկոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>14,"name" => "Ոսկրային ուռուցքաբանության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Ընդհանուր և մանկական ուռուցքաբանության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Ճառագայթային ուռուցքաբանության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Ռադիոգինեկոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Ընդհանուր և մանկական քիմիաթերապիայի բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Թորակալ վիրաբուժության բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//        ["code"=>1,"name" => "Կանանց առողջության կլինիկա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => true],
//
//        // "has_bads" => false]
//        ["name" => "Ռադիոիզոտոպային հետազոտության խումբ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Միջուկային բժշկության ստորաբաժանում", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Անզգայացման և վերակենդանացման բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Համալիր և ռենտգեն ախտորոշման բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Էնդոսկոպիկ և ուլտրաձայնային ախտորոշման բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Կլինիկական-պաթոմորֆոլոգիական բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Կլինիկական-կենսաքիմիայի, իմունաբանության լաբորատորիա", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Ընդհանուր հիվանդանոցային անձնակազմ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Վիրահատարան", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        // --> end medical departments
//
//        // other departments
//        ["name" => "Վարչական  անձնակազմ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Հաշվապահություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Կադրերի  բաժին", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Գնումների  բաժին", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Ինժեներական խումբ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Տնտեսական ծառայություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Դեղատուն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Ներհիվանդանոցային վիճակագրական խումբ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Հանրապետական ուռուցքաբանության վիճակագրական խումբ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Արխիվ", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Ամբուլատոր-դիսպանսեր հսկողության բաժանմունք և ընդունարան", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Ախտորոշման ծառայություն", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
//        ["name" => "Պալիատիվ թերապիայի բաժանմունք", "closed_from_outside" => false, "closed_from_inside" => false, "has_bads" => false],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename=public_path('department');
        $d = scandir($filename, SCANDIR_SORT_NONE );
        $content = file_get_contents(public_path('department/'.$d[2]));
        $arrContent = json_decode($content, true);
        foreach ($arrContent as $item) {
            $department = Department::create([
                "name" => $item["name"],
                "code" => $item["code"],
                "closed_from_inside" => $item["closed_from_inside"],
                "closed_from_outside" => $item["closed_from_outside"],
                "has_bads" => $item["has_bads"]
            ]);

            $chamber = $department->chambers()->create(["number" => 1]);

            $chamber->beds()->create(["number" => 1, "is_occupied" => false]);
            $chamber->beds()->create(["number" => 2, "is_occupied" => true]);
        }
    }
}
