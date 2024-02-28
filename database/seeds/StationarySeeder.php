<?php

use App\Enums\StationaryAgeTypeEnum;
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum;
use App\Enums\StationaryWorkEfficiencyEnum;
use App\Models\Stationary;
use App\Models\StationaryDiagnosis;
use App\Models\User;
use Illuminate\Database\Seeder;

class StationarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc = User::where('username', 's.simonyan')->first();
        $dep_head =  User::where('username', 'armen.nikoghosyan')->first();

        $stationary = Stationary::create([
            "patient_id" => 1,
            "height" => 172.5,
            "weight" => 82.7,
            "age" => 18,
            "age_type" => StationaryAgeTypeEnum::year(),
            "number" => 1,
            "admission_date" => now(),
            "discharge_date" => now(),
            "chamber" => 1,
            "is_paid" => true,
            "clinic_id" => 6,
            "is_urgent" => true,
            "hours_later" => 4,
            "department_id" => 1,
            "days_qty" => 7,
            "bed" => 1,
            "is_planned" => false,
            "malaria_endemic_zone" => false,
            "work_efficiency_status" => StationaryWorkEfficiencyEnum::other(),
            "work_efficiency_comment" => "Ինչ որ ազատ տեքստ",
            "attending_doctor_id" => $doc->id,
            "department_head_id" => $dep_head->id,
            // 'tnm' => "oxx",
            "T" => '0_a',
            "N" => 'x_b',
            "M" => '1_a',

            "Grade" => '4',
            "L" => '1',
            "V" => '2',
            "pycmr" => 'm',

            'stage' => "I b",
            'from_disease_start' => 1
        ]);

        $stationary->tumor_treatments()->attach(3);

        // head-of-document
        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::primary_disease(),
            "disease_id" => 4,
            "diagnosis_comment" => "Նկատվում է հիվանդության սրացում"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::admission(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության սրացում"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::referring_institution(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::clinical(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::final_clinical(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::concomitant_disease(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::disease_complication(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_diagnoses()->create([
            "diagnosis_type" => StationaryDiagnosisEnum::tuberculosis_complaint(),
            "disease_id" => 2,
            "diagnosis_comment" => "Նկատվում է հիվանդության նահանջ ստացինոնար ընդունվելուց"
        ]);

        $stationary->stationary_medicine_side_effects()->create([
            "type" => StationaryMedicineSideEffectEnum::intolerance(),
            "medicine_id" => 1,
            "medicine_comment" => "Lorem Ipsum dolor sit amet"
        ]);

        $stationary->stationary_medicine_side_effects()->create([
            "type" => StationaryMedicineSideEffectEnum::intolerance(),
            "medicine_id" => 2,
            "medicine_comment" => "Lorem Ipsum dolor sit amet 2"
        ]);
    }
}
