<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\HospitalizationReferral;

class HospitalizationReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospitalization_referrales = HospitalizationReferral::create([
            // 'user_id' => 1,
            'patient_id' => 1,
            'attending_doctor_id' => 1,
            'department_head_id' => 1,
            'diagnosis' => 'Բարորակ ուռուցք',
            'medical_measure' => 'Միջոցառում',
            'accept' => false,
            'referral_date' => now(),
        ]);
    }
}
