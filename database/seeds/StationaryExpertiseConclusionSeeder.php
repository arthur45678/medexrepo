<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;

class StationaryExpertiseConclusionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_expertise_conclusions()->create([
            "conclusion" => "Lorem ipsum dolor sit amet"
        ]);
    }
}
