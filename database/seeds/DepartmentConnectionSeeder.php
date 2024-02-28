<?php

use Illuminate\Database\Seeder;

use App\Models\DepartmentConnection;
use App\Models\User;

class DepartmentConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('username', '=', 'm.makaryan')->first();
        for ($i=1; $i < 5; $i++) {
            DepartmentConnection::create([
                'user_id' => $user->id,
                'department_id' => $i
            ]);
        }
    }
}
