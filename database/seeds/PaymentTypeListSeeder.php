<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentTypeList;

class PaymentTypeListSeeder extends Seeder
{
    public $payment_types = [
        ['name' => 'paid', 'status' => 'active'],
        ['name' => 'state_order', 'status' => 'active'],
        ['name' => 'social_insurance', 'status' => 'active'],
        ['name' => 'co_payment', 'status' => 'active']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->payment_types as $value) {
            PaymentTypeList::create($value);
        }

    }
}
