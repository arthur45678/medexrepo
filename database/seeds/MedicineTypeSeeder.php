<?php

use Illuminate\Database\Seeder;
use \App\Models\MedicineType;

class MedicineTypeSeeder extends Seeder
{

    public function run()
    {
        MedicineType::create([
        'code' => '031',
        'type' => 'humanitarian',
        'name'=>'Լաբոր. Նյութ. Հում.պահեստ',
    ]);
        MedicineType::create([
        'code' => '032',
        'type' => 'humanitarian',
        'name'=>'Հոգեմետ դեղ.Հում.պահեստ',
    ]);
        MedicineType::create([
        'code' => '033',
        'type' => 'humanitarian',
        'name'=>'Քիմիոպրեպարատների Հում.պահեստ',
    ]);
        MedicineType::create([
        'code' => '034',
        'type' => 'humanitarian',
        'name'=>'Հումանիտար  դեղորայքի պահեստ',
    ]);

        MedicineType::create([
        'code' => '025',
        'type' => 'material',
        'name'=>'ԲՆԱ',
    ]);
    MedicineType::create([
        'code' => '026',
        'type' => 'material',
        'name'=>'Ախտահանիրչ',
    ]);
    MedicineType::create([
        'code' => '08',
        'type' => 'material',
        'name'=>'Հոգեմետ դեղորայք',
    ]);
    MedicineType::create([
        'code' => '09',
        'type' => 'material',
        'name'=>'Քիմիո պրեպարատներ',
    ]);
    MedicineType::create([
        'code' => 10,
        'type' => 'material',
        'name'=>'Վիրակապական միջոցներ',
    ]);
    MedicineType::create([
        'code' => 11,
        'type' => 'material',
        'name'=>'Լաբորատոր ռեակտիվներ',
    ]);
    MedicineType::create([
        'code' => 12,
        'type' => 'material',
        'name'=>'Դեղորայք',
    ]);
    MedicineType::create([
        'code' => 13,
        'type' => 'material',
        'name'=>'Փոշիներ',
    ]);
    MedicineType::create([
        'code' => '133',
        'type' => 'material',
        'name'=>'Կոմպլեկտ',
    ]);
    MedicineType::create([
        'code' => 14,
        'type' => 'material',
        'name'=>'Հումանիտար օգնության միջոցներ',
    ]);
    MedicineType::create([
        'code' => '02',
        'type' => 'warehouses',
        'name'=>'Դեղորայքի պահեստ',
    ]);
    MedicineType::create([
        'code' => '04',
        'type' => 'warehouses',
        'name'=>'Հոգեմետ դեղորայքի պահեստ',
    ]);
    MedicineType::create([
        'code' => '05',
        'type' => 'warehouses',
        'name'=>'Քիմպրեպարատների  պահեստ',
    ]);
    MedicineType::create([
        'code' => '06',
        'type' => 'warehouses',
        'name'=>'Փոշիների պահեստ',
    ]);
    MedicineType::create([
        'code' => 37,
        'type' => 'warehouses',
        'name'=>'Սեփական արտադրության դեղորայքի պ',
    ]);



    }


}
