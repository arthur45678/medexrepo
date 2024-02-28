<?php

use Illuminate\Database\Seeder;
use App\Models\LivingPlaceList;

class LivingPlaceListSeeder extends Seeder
{

    protected $living_places = [
        ['name' => 'Քաղաքաբնակ'],
        ['name' => 'Գյուղաբնակ'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->living_places as $living_place) {
            LivingPlaceList::create($living_place);
        }
    }
}
