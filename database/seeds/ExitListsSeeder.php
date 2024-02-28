<?php


use Illuminate\Database\Seeder;
use  \App\Models\ExitList;
class ExitListsSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            ["name" => "մեկնել է հանրապետությունից" ],
            ["name" => "տվյալները բացակայում են" ],
            ["name" => "Մահացել է հիմնական հիվանդությունից" ],
            ["name" => "մահացել է վիրահատական բարդությունից" ],
            ["name" => "Մահացել է այլ հիվանդությունից" ],
            ["name" => "Մահացել է այլ պատճառով" ],


        ];
        foreach ($samples as $samplesOther) {
            ExitList::create([
                "name" => $samplesOther['name'],

            ]);
        }
    }
}
