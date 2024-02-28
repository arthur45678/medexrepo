<?php

use Illuminate\Database\Seeder;
use \App\Models\ResearchesList;

class ResearchesListsSeeder extends Seeder
{
    public function run()
    {
        $samples = [
            ['name' => 'Հյուսվածքաբանական'],
            ['name' => 'Բջջաբանական'],
            ['name' => 'Ցիտոքիմիական'],
            ['name' => 'Իմունոֆենոտիպավորում'],
            ['name' => 'Կորիզա-մագնիսական-կոնտրաստով'],
            ['name' => 'Կորիզա-մագնիսական-առանց կոնտրաստ'],
            ['name' => 'Համակարգչային շերտագրություն-կոնտրաստով'],
            ['name' => 'Համակարգչային շերտագրություն -առանց կոնտրաստ'],
            ['name' => 'Ռենտգեն-առանց կոնտրաստ'],
            ['name' => 'Ռենտգեն-կոնտրաստով'],
            ['name' => 'Ուլտրաձայնային'],
            ['name' => 'Էնդոսկոպիկ'],
            ['name' => 'Իզոտոպ մեթոդով'],
            ['name' => 'Միայն կլինիկորեն'],
            ['name' => 'Օնկոմարկեր'],
            ['name' => 'ՊԵՏ ԿՏ'],
            ['name' => 'Իմելոգրաֆիա'],
            ['name' => 'Ցիտոլոգիական'],
            ['name' => 'Իմունոգենետիկական'],
            ['name' => 'Ցիտոգենետիկ'],
            ['name' => 'Դիահերձում'],
            ['name' => 'Ախտորոշիչ վիրահատություն'],
            ['name' => 'Այլ'],
        ];

        foreach ($samples as $samplesOther) {
            ResearchesList::create([
                "name" => $samplesOther['name'],
            ]);
        }
    }
}
