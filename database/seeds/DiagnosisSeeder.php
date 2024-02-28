<?php

use Illuminate\Database\Seeder;
use App\Models\Diagnosis;
use App\Models\User;
use App\Models\Ambulator;
use App\Models\DiseaseList;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ambulator_first = Ambulator::first();
        $disease_first = DiseaseList::first();
        $disease_second = DiseaseList::find(2);

        # preliminary diagnosis
        $ambulator_first->diagnoses()->create([
            'user_id' => User::find(1)->id,
            'ambulator_id'=>1,

            'disease_id'=> $disease_first->id,
            'diagnosis_comment' => 'Նկատվում է ձախ թոքի մետաստազ',
            'diagnosis_date' => date('Y-m-d H:i:s', time()),
            'type' => 'preliminary',
        ]);

        # preliminary final
        Diagnosis::create([
            'user_id' => User::find(1)->id,
            'ambulator_id' => 1,

            'disease_id'=> $disease_second->id,
            'diagnosis_comment' => 'Նկատվում է փայծախի մետաստազ',
            // 'diagnosis_date' => date('Y-m-d H:i:s', time() + (15 * 24 * 60 * 60)),
            'diagnosis_date' => date('Y-m-d H:i:s', time()),
            'type' => 'final',
        ]);
    }
}
