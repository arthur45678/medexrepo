<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;
use App\Models\Tnm;

class TnmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator = Ambulator::first();

        Tnm::create([
            'T' => 0,
            'N' => 3,
            'M' => 'x',

            // 'user_id', // HasUserId trait
            'tnmable_id' => $ambulator->id,
            'tnmable_type' => get_class($ambulator)
        ]);
    }
}
