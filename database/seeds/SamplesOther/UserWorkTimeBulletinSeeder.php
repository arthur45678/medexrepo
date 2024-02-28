<?php

use Illuminate\Database\Seeder;
use App\Models\OtherSamples\DepartmentWorkTimeBulletin;
use App\Models\User;

class UserWorkTimeBulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $worktime = DepartmentWorkTimeBulletin::default_worktime();
        $department_work_time_bulletin = DepartmentWorkTimeBulletin::where([
            ['user_id', '=', 1],
            ['department_id', '=', 1]
        ])->first();
        $users = User::where('department_id', '=', 1)->get();
        foreach ($users as $user) {
            $user->user_work_time_bulletins()->create([
                'department_work_time_bulletin_id' => $department_work_time_bulletin->id,
                'worktime' => json_encode($worktime)
            ]);
        }
    }
}
