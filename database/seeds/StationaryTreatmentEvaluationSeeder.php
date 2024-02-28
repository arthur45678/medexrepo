<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;
use App\Models\StationaryTreatmentEvaluation;

use App\Enums\StationaryTreatmentEvaluation\EasternCooperativeOncologyGroupEnum;
use App\Enums\StationaryTreatmentEvaluation\KarnofskyPerformanceScaleEnum;
use App\Enums\StationaryTreatmentEvaluation\TreatmentEffectivenessEnum;

class StationaryTreatmentEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();

        $treatment_evaluation = $stationary->stationary_treatment_evaluation ?? new StationaryTreatmentEvaluation();
        $treatment_evaluation->stationary_id = $stationary->id;
        $treatment_evaluation->eastern_cooperative_oncology_group = EasternCooperativeOncologyGroupEnum::first();
        $treatment_evaluation->karnofsky_performance = KarnofskyPerformanceScaleEnum::percent60();
        $treatment_evaluation->treatment_effectiveness = TreatmentEffectivenessEnum::partialRegression();
        $treatment_evaluation->save();
    }
}
