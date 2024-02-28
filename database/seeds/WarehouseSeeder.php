<?php

use Illuminate\Database\Seeder;
use  \App\Models\Samples\WarehouseModels;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Samples\WarehouseModels::class, 200)->create();
    }

}
