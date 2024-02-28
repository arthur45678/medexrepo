<?php

use Illuminate\Database\Seeder;
use App\Models\Ambulator;
use App\Models\MeasurementUnit;

class HealthStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulator_first = Ambulator::first();
        $measurement_unit = MeasurementUnit::first();

        $health_status = $ambulator_first->health_statuses()->create([
            'health_status_date' => date('Y-m-d', time()),
            'health_status_text' => 'Հիվանդի առողջական վիճակը բավարար է։ Նկատվում է ուռուցքի նահանջ'
        ]);

        // prescriptions
        $health_status->prescriptions()->create([
            'patient_id' => $ambulator_first->patient_id,
            'ambulator_id' => $ambulator_first->id,
            // 'health_status_id'=> already here in "health_status"

            'medicine_id' => 11,
            'medicine_dose' => 12,
            'measurement_unit_id' => $measurement_unit->id,
            'prescription_text' => 'Օրը երեք անգամ՝ ուտելուց առաջ։',
        ]);
    }
}
