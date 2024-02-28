<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\ErythrocyteMorphology;
use App\Models\User;

class ErythrocyteMorphologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc = User::where('username', 'm.makaryan')->first();
        $erythrocyte_morphology = ErythrocyteMorphology::create([
            // 'user_id' => 1,
            'patient_id' => 1,
            'attending_doctor_id' => $doc->id,
            'anocytosis_comment' => 'Անոզիցիտոզ',
            'poikilocytosis_comment' => 'պոյկիլոցիտոզ',
            'basophil_comment' => 'Բազոֆիլ',
            'polychromatophilia_comment' => 'պոլխրոմատոֆիլիա',
            'jolie_bodies_comment' => 'ժոլիի մարմիններ',
            'erythronormoblasts_comment' => 'էրիթրոնորմոբլաստներ',
            'mesaloblasts_comment' => 'մեզալոբլաստներ',
            'nuclear_over_segmentation_comment' => 'Կորիզների գերսեգմենտացում',
            'toxic_fatification_comment' => 'տոքսոգեն ֆատիկավորում',

            'analysis_response_date' => now(),

        ]);

        $erythrocyte_morphology->approvement()->create(["department_id" => 1, "status" => 0]);
    }
}
