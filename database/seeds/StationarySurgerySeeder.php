<?php

use App\Enums\StationarySurgeryEnum;
use App\Models\Stationary;
use Illuminate\Database\Seeder;

class StationarySurgerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_surgeries()->create([
            "type" => StationarySurgeryEnum::stationary(),
            "surgery_id" => 1,
            "anesthesia_id" => 1,
            "surgery_date" => now(),
            "complications" => "Հետվիրահատական բարդությունների նկարագրություն"
        ]);
    }
}
