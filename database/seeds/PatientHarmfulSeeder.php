<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Harmful;

class PatientHarmfulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient_one = Patient::first();
        $patient_one->harmfuls()->attach(Harmful::find(5)->id);
        $patient_one->harmfuls()->attach(Harmful::find(10)->id);
    }
}
