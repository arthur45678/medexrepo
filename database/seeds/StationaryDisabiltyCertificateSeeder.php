<?php

use Illuminate\Database\Seeder;

use App\Models\Stationary;

class StationaryDisabiltyCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_disability_certificates()->create([
            "number" => 1,
            "from" => now(),
            "to" => now()->addMonth(),
        ]);
    }
}
