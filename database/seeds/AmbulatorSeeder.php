<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class AmbulatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # new ambulator card
        $patient_one = Patient::first();
        $patient_one->ambulator()->create([
            'number' => 7,
            'registration_date' => date('Y-m-d H:i:s', time()),
            'is_a_twin' => false
        ]);
    }
}
