<?php

use App\Enums\TumorTreatmentEnum;
use App\Models\TumorTreatmentList;
use Illuminate\Database\Seeder;

class TumorTreatmentListSeeder extends Seeder
{

    private function get_tumor_treatments(): array
    {
        return [
            [
                "type" => TumorTreatmentEnum::special_treatment(),
                "name" => "վիրահատական",
            ],
            [
                "type" => TumorTreatmentEnum::special_treatment(),
                "name" => "ճառագայթային",
            ],
            [
                "type" => TumorTreatmentEnum::special_treatment(),
                "name" => "դեղորայքային",
            ],
            [
                "type" => TumorTreatmentEnum::special_treatment(),
                "name" => "համակցված",
            ],
            [
                "type" => TumorTreatmentEnum::special_treatment(),
                "name" => "համալիր",
            ],
            [
                "type" => TumorTreatmentEnum::palliative(),
                "name" => "պալիատիվ",
            ],
            [
                "type" => TumorTreatmentEnum::symptomatic(),
                "name" => "սիմպտոմատիկ",
            ],
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->get_tumor_treatments() as $tt) {
            TumorTreatmentList::create($tt);
        }
    }
}
