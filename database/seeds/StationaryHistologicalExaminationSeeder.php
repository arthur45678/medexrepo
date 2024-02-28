<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;

class StationaryHistologicalExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_histological_examinations()->create([
            "examination" => "Lorem ipsum dolor sit amet",
            "examination_date" => now(),
            "examination_number" => 123456791
        ]);
    }
}
