<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\BloodTransfusionRecordBook;

class BloodTransfusionRecordBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blood_transfusion_record_book = BloodTransfusionRecordBook::create([
            'patient_id' => 1,
            'bag_number' => "23 , II",

        ]);
    }
}
