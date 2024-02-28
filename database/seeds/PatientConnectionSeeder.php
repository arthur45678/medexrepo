<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use APP\Models\Patient;
use App\Models\Department;

class PatientConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user_simon = User::find(1);
        // $user_makar = User::find(2);

        $user_simon = User::where('username', 's.simonyan')->first(); // department 1 - closed from outside
        $user_Hmayak = User::where('username', 'Hmayak.epremyan')->first(); // department 1 - closed from outside

        $user_makar = User::where('username', 'm.makaryan')->first(); //  department 2 - open from outside
        $user_irina = User::where('username', 'irina.khachatryan')->first(); //  department 2 - open from outside

        $user_makar->sent_patients()->attach(
            Patient::find(1),
            [
                'receiver_id' => $user_simon->id,
                'department_id' => null
            ]
        );

        $user_simon->sent_patients()->attach(
            Patient::find(2),
            [
                'receiver_id' => $user_makar->id,
                'department_id' => null
            ]
        );

        $user_Hmayak->sent_patients()->attach(
            Patient::find(3),
            [
                'receiver_id' => null,
                'department_id' => $user_makar->department_id
            ]
        );

        $user_irina->sent_patients()->attach(
            Patient::find(4),
            [
                'receiver_id' => null,
                'department_id' => $user_simon->department_id
            ]
        );
    }
}
