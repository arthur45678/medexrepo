<?php

use \App\Models\OtherSamples\OtherSimplesModel;
use Illuminate\Database\Seeder;

class SampesOtherSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            [
                "name" => "ՏԵԽՆԻԿԱԿԱՆ ԲՆՈՒԹԱԳԻՐ-ԳՆՄԱՆ ԺԱՄՆԱԿԱՑՈՒՅՑ",
                "path" => "ptc",
                "table" => "procurement_technical_characteristics",
            ],
            [
                "name" => "Աշխատաժամանակի հաշվարկի տեղեկագիր",
                "path" => "departments.work-time-bulletins",
                "table" => "department_work_time_bulletins",
            ],
            [
                "name" => "ԿԱՏԱՐՎԱԾ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆՆԵՐԻ ՀԱՇՎԱՌՈՒՄ",
                "path" => "accounting-for-research",
                "table" => "accounting_for_research",
            ]
        ];

        foreach ($samples as $samplesOther) {
            OtherSimplesModel::create([
                "name" => $samplesOther['name'],
                "path" => $samplesOther['path'],
                "table" => $samplesOther['table']
            ]);
        }
    }
}
