<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;

class StationaryPathologicalAnatomicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();
        $stationary->stationary_pathological_anatomical()->create([
            'autopsy_date' => now(),
            'autopsy_protocol' => 787,
            'cause_of_death' => 'Ճակատագիր',
            'pathological_anatomical_epicrisis' => 'Սրտիս ողբաձայն հառաչանքների աղաղակն, ահա, Դէպ երկինքն ի վեր` քեզ եմ ընծայում, գաղտնատե՛ս Աստուած.'
        ]);
    }
}
