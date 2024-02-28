<?php
use Illuminate\Database\Seeder;
use App\Models\Samples\Reference;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $references = Reference::create([
            // 'user_id' => 1,
            'patient_id' => 1,
            'attending_doctor_id' => 2,
            'department_head_id' => 1,
            'chief_doctor_id' => 1,
            'date' =>  now() ,
            'reference_diagnosis' => 'ինչ որ տեքստ',
            'treatment' => 'ինչ որ տեքստ',
            'doctor_advice' => 'ինչ որ տեքստ',
            'from_date' =>  now(),
            'to_date' =>  now(),
        ]);
    }
}
