<?php


use Illuminate\Database\Seeder;
use  \App\Models\CurrentStageList;
class CurrentStageListsSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            ["name" => "I a" ],
            ["name" => "I b" ],
            ["name" => "I c" ],
            ["name" => "I փուլ" ],
            ["name" => "II a" ],
            ["name" => "II b" ],
            ["name" => "II c" ],
            ["name" => "II փուլ" ],
            ["name" => "III a" ],
            ["name" => "III b" ],
            ["name" => "III c" ],
            ["name" => "III փուլ"],
            ["name" => "Iv a"],
            ["name" => "Iv b"],
            ["name" => "Iv c"],
            ["name" => "IV փուլ"],
            ["name" => "n Situ"],
            ["name" => "Կիրառելի չէ"],
            ["name" => "Անհայտ է"],

        ];
        foreach ($samples as $samplesOther) {
           CurrentStageList::create([
                "name" => $samplesOther['name'],

            ]);
        }
    }
}
