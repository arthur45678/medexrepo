<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator_first = Ambulator::first();
        $ambulator_first->complaints()->create([
            'user_id' => 1,
            'complaint_text' => 'հիվանդի գանգատներ հիվանդի գանգատներ հիվանդի գանգատներ հիվանդի գանգատներ',
            'complaint_date' => date('Y-m-d H:i:s', time())
        ]);
    }
}
