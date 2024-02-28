<?php

use App\Models\Stationary;
use Illuminate\Database\Seeder;

class StationaryTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::find(1);

        $stationary->stationary_treatments()->create(["treatment_id" => 1, "treatment_comment" => "Lorem Ispum Dolor Sit"]);
    }
}
