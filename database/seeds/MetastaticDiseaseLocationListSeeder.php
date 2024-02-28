<?php

use Illuminate\Database\Seeder;
use App\Models\MetastaticDiseaseLocationList;

class MetastaticDiseaseLocationListSeeder extends Seeder
{
    protected $metastatic_disease_location_list = [
        ['code' => 'OSS', 'name' => 'Ոսկրային հյուսվածք'],
        ['code' => 'PUL', 'name' => 'Թոքեր'],
        ['code' => 'HEP', 'name' => 'Լյարդ'],
        ['code' => 'BRA', 'name' => 'Գլխուղեղ'],
        ['code' => 'LYM', 'name' => 'Ավշային հանգույցներ'],
        ['code' => 'MAR', 'name' => 'Ոսկրածուծ'],
        ['code' => 'PLE', 'name' => 'Թոքամիզ'],
        ['code' => 'PER', 'name' => 'Որովայնամիզ'],
        ['code' => 'ADR', 'name' => 'Մակերիկամ'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->metastatic_disease_location_list as $metastatic_disease_location) {
            MetastaticDiseaseLocationList::create($metastatic_disease_location);
        }
    }
}
