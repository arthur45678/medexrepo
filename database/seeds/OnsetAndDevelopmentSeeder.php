<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;

class OnsetAndDevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator_first = Ambulator::first();
        $ambulator_first->onset_and_developments()->create([
            'user_id'=>1,
            'oad_comment'=>'Սույն կայքում տեղ գտած լրատվական հրապարակումների հեղինակային իրավունքը պատկանում է բացառապես NEWS.am լրատվական-վերլուծական:',
            'oad_date'=>date('Y-m-d H:i:s', time())
        ]);
    }
}
