<?php

use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum;
use App\Models\Stationary;
use Illuminate\Database\Seeder;

class StationaryPrimaryExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_primary_examination()->create([
            "examination_date" => now(),
            "complaints" => "Lorem Ipsum Dolor Sit Amet",
            "anamnesis_morbi" => "Lorem Ipsum Dolor Sit Amet",
            "growth_and_development" => "Lorem Ipsum Dolor Sit Amet",
            "inheritance" => "Lorem Ipsum Dolor Sit Amet",
            "sextual_history" => "Lorem Ipsum Dolor Sit Amet",

            "menarche_age" => 16,
            "last_mensis" => now(),
            "menopausa_age" => 16,
            "number_of_pregnancies" => 1,
            "number_of_abortions" => 1,
            "number_of_interruptions" => 1,
            "number_of_births" => 1,
            "cycle_from" => 1,
            "cycle_to" => 1,

            "breast_feeding" => true,
            "breast_feeding_comment" => "Lorem Ipsum Dolor Sit Amet",

            "taking_hormonal_drugs" => false,
            "taking_hormonal_drugs_comment" => "Lorem Ipsum Dolor Sit Amet",
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::previous_disease(),
            "disease_id" => 14,
            "diagnosis_comment" => "Lorem Ipsum Dolor Sit Amet",
        ]);

        $stationary->stationary_medicine_side_effects()->create([
            "type" => StationaryMedicineSideEffectEnum::allergy(),
            "medicine_id" => 1,
            "medicine_comment" => "Lorem Ipsum Dolor Sit Amet"
        ]);

        $stationary->stationary_harmfuls()->create([
            "harmful_id" => 3,
            "harmful_comment" => "Lorem Ipsum Dolor Sit Amet"
        ]);
    }
}
