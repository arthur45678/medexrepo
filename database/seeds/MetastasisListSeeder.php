<?php


use Illuminate\Database\Seeder;
use \App\Models\Metastasis_list;
class MetastasisListSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            ["name" => "Գլխուղեղ" ],
            ["name" => "Լյարդ" ],
            ["name" => "Ոսկրեր" ],
            ["name" => "Թոքեր" ],
            ["name" => "Որովայնամիզ" ],
            ["name" => "Մակերիկամ" ],
            ["name" => "Երիկամ" ],
            ["name" => "Մաշկ" ],
            ["name" => "Փափուկ հյուսվածքներ" ],
            ["name" => "Այլ տեղակայում + A" ],


        ];
        foreach ($samples as $samplesOther) {
           Metastasis_list::create([
                "name" => $samplesOther['name'],

            ]);
        }
    }
}
