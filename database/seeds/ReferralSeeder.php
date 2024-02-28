<?php

use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\StateOrderedService;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referral_one = Referral::create([
            'sender_id' => 3,
            'receiver_id' => 2,
            'department_id' => 32,
            'patient_id' => 3
        ]);

        $additional_one = [
            'payment_type' => 'state_order',
            'comment' => 'some comment about service state_order id=4'
        ];

        $state_ordered_service = StateOrderedService::find(4);
        $state_ordered_service->referral_service()->create([
            'referral_id' => $referral_one->id,
            'payment_type' => $additional_one['payment_type'],
            'comment' => $additional_one['comment'],
        ]);
    }
}
