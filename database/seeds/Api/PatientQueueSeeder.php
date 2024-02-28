<?php

use Illuminate\Database\Seeder;
use App\Models\Api\Patient;
// use App\Models\Api\Queue;

class PatientQueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient_data = array(
                'f_name' => 'Սերո',
                'l_name' => 'Խանզադյան',
                'email' => 'sero.xanzadyan@gmail.com',
                'phone' => '091123456',
                'soc_card' => '2000000123456',

                'password' => bcrypt('password'),
                // 'c_password' => bcrypt('password'),
        );

        $patient = Patient::create($patient_data);
        $queue_data = array(
            'number'=> 1,
            'comment' => 'I want to enqueue մամոլոգիայի բաժին',
            'enqueue_date' => now(),
            'user_id' => 1,
            // 'patient_id' => 1,
            'department_id' => 1,
        );
        $queue =  $patient->queue()->create($queue_data);
    }
}
