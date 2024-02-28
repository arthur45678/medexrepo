<?php

use Illuminate\Database\Seeder;
use App\Models\Pharmacy\PharmacyModel;
class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PharmacyModel::create([

        'medicine_id' => 1,
        'medicine_code' => '.01426',
        'unit_of_measurement'=>2,
        'department_id' => 1,
        'price'=>150,
        'balance_of_the_month'=>5,
        'enter'=>6,
        'balance_end_math_count'=>13,
    ]);
        PharmacyModel::create([

        'medicine_id' => 2,
        'medicine_code' =>'.01429',
        'unit_of_measurement'=>1,
        'department_id' => 1,
        'price'=>250,
        'balance_of_the_month'=>7,
        'enter'=>16,
        'balance_end_math_count'=>23,
    ]);
        PharmacyModel::create([

        'medicine_id' => 3,
        'medicine_code' =>'.01433',
        'department_id' => 1,
        'unit_of_measurement'=>3,
        'price'=>5010,
        'balance_of_the_month'=>7,
        'enter'=>10,
        'balance_end_math_count'=>17,
    ]);
        PharmacyModel::create([

        'medicine_id' => 4,
        'medicine_code' =>'00001',
        'unit_of_measurement'=>2,
        'department_id' => 1,
        'act' => 'act',
        'price'=>2560,
        'balance_of_the_month'=>4,
        'enter'=>100,
        'balance_end_math_count'=>104,
    ]);
        PharmacyModel::create([

        'medicine_id' => 5,
        'medicine_code' =>'00002',
        'unit_of_measurement'=>4,
        'department_id' =>1,
        'act' => 'act',
        'price'=>960,
        'balance_of_the_month'=>3,
        'enter'=>17,
        'balance_end_math_count'=>20,
    ]);
        PharmacyModel::create([

        'medicine_id' => 1,
        'medicine_code' => '.01426',
        'unit_of_measurement'=>2,
        'department_id' =>1,
        'act' => 'act',
        'price'=>860,
        'balance_of_the_month'=>6,
        'enter'=>10,
        'balance_end_math_count'=>16,
    ]);


    }
}
