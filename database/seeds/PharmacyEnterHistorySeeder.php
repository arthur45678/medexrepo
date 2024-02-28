<?php

use Illuminate\Database\Seeder;
use App\Models\Pharmacy\PharmacyEnterHistory;
class PharmacyEnterHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PharmacyEnterHistory::create([

        'medicine_id' => 1,
        'department_id' => 3,
        'enter'=>6,
    ]);
        PharmacyEnterHistory::create([

            'medicine_id' => 2,
            'department_id' => 4,
            'enter'=>16,
    ]);
        PharmacyEnterHistory::create([

            'medicine_id' => 1,
            'department_id' => 1,
            'enter'=>7,
    ]);
        PharmacyEnterHistory::create([

            'medicine_id' => 4,
            'department_id' => 1,
            'enter'=>3,
    ]);
        PharmacyEnterHistory::create([

            'medicine_id' => 4,
            'department_id' => 2,
            'enter'=>16,
    ]);
        PharmacyEnterHistory::create([

            'medicine_id' => 5,
            'department_id' => 1,
            'enter'=>16,
    ]);


    }
}
