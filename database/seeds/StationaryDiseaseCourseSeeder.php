<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;
use App\Models\MeasurementUnit;

class StationaryDiseaseCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();
        $measurement_unit = MeasurementUnit::first();

        $disease_course = $stationary->stationary_disease_courses()->create([
            'disease_course_date' =>  now(),
            'disease_course_comment' => 'հիվանդության ընթացքը - course of the disease - հիվանդության ընթացքը'
        ]);

        // stationary_disease_course_prescription
        $disease_course->stationary_prescriptions()->create([
            'patient_id' => 1,
            'stationary_id' => $stationary->id,
            // 'stationary_disease_course_id' => $disease_course->id, // automate

            'medicine_id' => 33,
            'medicine_dose' => 44,
            'measurement_unit_id' => $measurement_unit->id,
            'prescription_text' => 'Օրը 3 անգամ՝ ուտելուց առաջ։'
        ]);

    }
}
