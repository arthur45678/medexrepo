<?php

use Illuminate\Database\Seeder;
use App\Models\MaritalStatusList;

class MaritalStatusListSeeder extends Seeder
{
    protected $marital_status_list = [
        ['name' => 'Ամուրի'],
        ['name' => 'Ամուսնացած'],
        ['name' => 'Ամուսնալուծված'],
        ['name' => 'Այրի'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->marital_status_list as $marital_status) {
            MaritalStatusList::create($marital_status);
        }
    }
}
