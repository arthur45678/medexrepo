<?php

use Illuminate\Database\Seeder;
use App\Models\WorkingFeatureList;

class WorkingFeatureListSeeder extends Seeder
{

    protected $working_feature_list = [
        ['name' => 'Քիմիական ազդեցություն'],
        ['name' => 'Կենսաբանական ազդեցություն'],
        ['name' => 'Արդյունաբերական'],
        ['name' => 'Ֆիզիկական ազդակներ'],
        ['name' => 'Մտավոր աշխատանք'],
        ['name' => 'Ժամային ծանրաբեռնվածություն'],
        ['name' => 'Ջերմային'],
        ['name' => 'Երեխաների հետ շփմամբ աշխատանք'],
        ['name' => 'Սննդին առնչվող աշխատանք'],
        ['name' => 'Առանց առանձնահատկությունների'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->working_feature_list as $working_feature) {
            WorkingFeatureList::create($working_feature);
        }
    }
}
