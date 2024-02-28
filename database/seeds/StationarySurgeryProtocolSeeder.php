<?php

use Illuminate\Database\Seeder;

use App\Models\Stationary;

class StationarySurgeryProtocolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_surgery_protocols()->create([
            "anesthesiologist_id" => 1,

            "date" => now(),
            "surgery_id" => 110,
            "surgery_name" => "Lorem Ipsum Dolor Sit Amet",
            "surgery_start" => now(),
            "surgery_end" => now()->addMonth(),

            "anesthesia_id" => 4,
            "medicine_id" => 3,
            "anesthesia_process" => "Lorem Ipsum Dolor Sit Amet"
        ]);
    }
}
