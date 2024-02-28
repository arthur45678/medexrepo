<?php

use Illuminate\Database\Seeder;
use App\Models\OtherSamples\DepartmentWorkTimeBulletin;

class DepartmentWorkTimeBulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepartmentWorkTimeBulletin::create([
            'user_id' => 1,
            'department_id' => 1,
        ]);
    }
}
