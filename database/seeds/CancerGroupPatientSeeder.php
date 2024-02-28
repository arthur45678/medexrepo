<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\CancerGroup;

class CancerGroupPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient_one = Patient::first();
        $patient_one->cancer_groups()->attach(CancerGroup::first());
        $patient_one->cancer_groups()->attach(CancerGroup::find(4));
    }
}
