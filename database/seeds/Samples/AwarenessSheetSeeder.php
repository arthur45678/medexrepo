<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\AwarenessSheet;

class AwarenessSheetSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $conscious_voluntary_consent = AwarenessSheet::create([
            'patient_id' => 1,
            'department_head_id' => 2,
            'attending_doctor_id' => 1,
            'director_id' => 1 ,
            'accept' => true ,
            'service_recipient' => 'Babajan Babajanyan',
            'first_date' => now(),
            'second_date' => now(),
        ]);
    }
}
