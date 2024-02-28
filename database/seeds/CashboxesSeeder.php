<?php

use Illuminate\Database\Seeder;

class CashboxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cashbox::create([
            'name' => 'Դրամարկղ 1',
            'slug' => 'cashboxFirst',
        ]);
        \App\Models\Cashbox::create([
            'name' => 'Դրամարկղ 2',
            'slug' => 'cashboxSecond',
        ]);
        \App\Models\Cashbox::create([
            'name' => 'Դրամարկղ 3',
            'slug' => 'cashboxThirth',
        ]);
        \App\Models\Cashbox::create([
            'name' => 'Դրամարկղ 4',
            'slug' => 'cashboxFour',
        ]);
    }
}
