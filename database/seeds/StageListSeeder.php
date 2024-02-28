<?php

use Illuminate\Database\Seeder;
use App\Models\StageList;

class StageListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            ['name'=>'I a', 'group'=>'I stage'],
            ['name'=>'I b', 'group'=>'I stage'],
            ['name'=>'I c', 'group'=>'I stage'],
            ['name'=>'I փուլ', 'group'=>'I stage'],

            ['name'=>'II a', 'group'=>'II stage'],
            ['name'=>'II b', 'group'=>'II stage'],
            ['name'=>'II c', 'group'=>'II stage'],

            ['name'=>'III a', 'group'=>'III stage'],
            ['name'=>'III b', 'group'=>'III stage'],
            ['name'=>'III c', 'group'=>'III stage'],

            ['name'=>'IV a', 'group'=>'IV stage'],
            ['name'=>'IV b', 'group'=>'IV stage'],
            ['name'=>'IV c', 'group'=>'IV stage'],

            ['name'=>'n Situ', 'group'=>'n Situ'],
            ['name'=>'Կիրառելի չէ', 'group'=>'not applicable'],
            ['name'=>'Անհայտ է', 'group'=>'unknown'],
        ];

        foreach($stages as $stage) {
            StageList::create([
                'name' => $stage['name'],
                'group'=> $stage['group']
            ]);
        }
    }
}
