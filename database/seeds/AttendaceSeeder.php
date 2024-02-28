<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;

class AttendaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator_first = Ambulator::first();
        $ambulator_first->attendances()->create([
            'user_id' => 1,
            'attendance_date' => date('Y-m-d H:i:s', time() - (45 * 24 * 60 * 60)),
        ]);
        $ambulator_first->attendances()->create([
            'user_id' => 1,
            'attendance_date' => date('Y-m-d H:i:s', time() - (30 * 24 * 60 * 60)),
        ]);
        $ambulator_first->attendances()->create([
            'user_id' => 1,
            'attendance_date' => date('Y-m-d H:i:s', time() - (15 * 24 * 60 * 60)),
        ]);
    }
}
