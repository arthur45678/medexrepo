<?php

use Illuminate\Database\Seeder;
use App\Models\MeasurementUnit;

class MeasurementUnitSeeder extends Seeder
{
    private $measurement_units = [
        [
            // մկգ
            "code" => 1,
            "name" => 'ug',
        ],
        [
            // մգ
            "code" => 2,
            "name" => 'mg',
        ],
        [
            // գ
            "code" => 3,
            "name" => 'g',
        ],
        [
            // մլ
            "code" => 4,
            "name" => 'ml',
        ],
        [
            // դլ
            "code" => 5,
            "name" => 'dl',
        ],
        [
            // լ
            "code" => 6,
            "name" => 'l',
        ],
        [
            // միավոր
            "code" => 7,
            "name" => 'unit',
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->measurement_units as $unit) {
            MeasurementUnit::create($unit);
        }
    }
}
