<?php


use Illuminate\Database\Seeder;
use  \App\Models\ApplicationPurposeList;
class ApplicationPurposeListSeeder extends Seeder
{

    public function run()
    {
        $samples = [
            ["name" => "Շուրջօրյա հսկողություն պահանջող" ],
            ["name" => "Շուրջօրյա հսկողություն չպահանջող" ],
            ["name" => "Հետազոտություն" ],
            ["name" => "Փորձաքննություն" ],


        ];
        foreach ($samples as $samplesOther) {
            ApplicationPurposeList::create([
                "name" => $samplesOther['name'],

            ]);
        }
    }
}
