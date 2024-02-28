<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrespondentAccountSeeder extends Seeder
{
    public $clinics_array = array(
        0 =>
            array(
                'code' => '0515',
            ),
        1 =>
            array(
                'code' => '0797',
            ),
        2 =>
            array(
                'code' => '0985',
            ),
        3 =>
            array(
                'code' => '0514',
            ),
        4 =>
            array(
                'code' => '1135',
            ),
        5 =>
            array(
                'code' => '0505',
            ),
        6 =>
            array(
                'code' => '0513',
            ),
        7 =>
            array(
                'code' => '1099',
            ),
        8 =>
            array(
                'code' => '0506',
            ),
        9 =>
            array(
                'code' => '0501',
            ),
        10 =>
            array(
                'code' => '0502',
            ),
        11 =>
            array(
                'code' => '0933',
            ),
        12 =>
            array(
                'code' => '1136',
            ),
        13 =>
            array(
                'code' => '0984',
            ),
        14 =>
            array(
                'code' => '0507',
            ),
        15 =>
            array(
                'code' => '0602',
            ),
        16 =>
            array(
                'code' => '2211',
            ),
        17 =>
            array(
                'code' => '2212',
            ),
        18 =>
            array(
                'code' => '2212/3',
            ),
        19 =>
            array(
                'code' => '2216/1',
            ),
        21 =>
            array(
                'code' => '61141',
            ),
        22 =>
            array(
                'code' => '611442/2',
            ),
        24 =>
            array(
                'code' => '61470',
            ),
        25 =>
            array(
                 'code' => '611445',
                )
    );


    public function run()
    {
        foreach($this->clinics_array as $unit) {
            \App\Models\CorrespondentAccount::create($unit);
        }

    }
}
