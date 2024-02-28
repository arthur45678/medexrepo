<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;
use App\Models\User;

class StationarySurgeryDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();

        $doc = User::where('username', 's.simonyan')->first();
        $assistent = User::where('username', 'Hmayak.epremyan')->first();
        $sister = User::where('username', 'nona.vardanyan')->first();

        $stationary->stationary_surgery_descriptions()->create([
            'surgery_description_date' =>  now(),
            'surgery_description_comment' => 'Վիրահատության նկարագրություն -ազատ դաշտ Վիրահատության նկարագրություն -ազատ դաշտ',
            'surgeon_id' => $doc->id,
            'assistant_id' => $assistent->id,
            'surgical_sister_id' => $sister->id
        ]);
    }
}
