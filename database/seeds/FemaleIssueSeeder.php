<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;

class FemaleIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator_first = Ambulator::first();
        $ambulator_first->female_issues()->create([
            'user_id' => 1,
            'number_of_births' => 2,
            'number_of_abortions' => 0,
            'date_of_last_birth' => date('Y-m-d', strtotime('1982-02-23')),
            'breastfeeding_complications' => 'Ունեցել է բարդություններ կրծքով կերակրելու շրջանում',
            'breast_inflammation' => 'Ունի կրծքագեղձի բորբոքում',
            'menstruation' => 'Վերջին դաշտանը 20.06.2020: Ուշացում՝ 7 օր։',
            'menstruation_date' => date('Y-m-d', time())
        ]);
    }
}
