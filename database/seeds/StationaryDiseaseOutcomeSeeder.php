<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;
use App\Enums\StationaryDiseaseOutcomeEnum;
use App\Enums\StationaryDeathCircumstanceEnum;

class StationaryDiseaseOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_disease_outcomes()->create([
            "outcome" => StationaryDiseaseOutcomeEnum::recovery(),
            "outcome_date" => now(),
            "death_circumstance" => StationaryDeathCircumstanceEnum::after_giving_birth(),
            "transferred_clinic_id" => 1
        ]);
    }
}
