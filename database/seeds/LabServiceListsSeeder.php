<?php


use Illuminate\Database\Seeder;
use    \App\Models\LabServiceList;
class LabServiceListsSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            ["name" => "Ընդ. արյան քնն" ],
            ["name" => "Ընդ. մեզի քնն" ],
            ["name" => "ԷՍԳ" ],
            ["name" => "Արյան խումբ և ռեզուս" ],
            ["name" => "Գլյուկոզա" ],
            ["name" => "Ընդ. սպիտակուց" ],
            ["name" => "Ընդ. բիլիռուբին" ],
            ["name" => "Ուղղ. բիլիռուբին" ],
            ["name" => "Անուղղ, բիլիռուբին" ],
            ["name" => "Միզանյութ" ],
            ["name" => "Մնացորդային ազոտ" ],
            ["name" => "Կրեատինին" ],
            ["name" => "Ասպարտատ ԱՏ (ԱՍՏ)" ],
            ["name" => "Սվանին ԱՏ (ԱՍՏ)" ],
            ["name" => "CA ընդհանուր" ],
            ["name" => "P ընդհանուր" ],
            ["name" => "Cl" ],
            ["name" => "Na*" ],
            ["name" => "K*" ],
            ["name" => "Պրոթրոմբինի ինդեքս" ],
            ["name" => "Թրոմբինային ժ֊կ" ],
            ["name" => "Ակտիվ, մասն, թրոմբոպւ ժ." ],
            ["name" => "Ռեկալցիֆիկացիայի ժ." ],
            ["name" => "Թրոմբոթեստ" ],
            ["name" => "Ֆիբրինոգեն" ],
            ["name" => "Հեպատիտ B" ],
            ["name" => "Հեպատիտ C" ],
            ["name" => "ՄԻԱՎ" ],
            ["name" => "RPR ՍԻՖԻԼԻՍ" ],
            ["name" => "Թոքերի R֊սկոպիա" ],
            ["name" => "Թոքերի R֊գրաֆիա" ],
            ["name" => "Հյոավածքաբաեական հետազ." ],
            ["name" => "Բջջաթանական հետազ." ],



        ];
        foreach ($samples as $samplesOther) {
            LabServiceList::create([
                "name" => $samplesOther['name'],

            ]);
        }
    }
}
