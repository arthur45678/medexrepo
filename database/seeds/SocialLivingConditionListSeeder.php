<?php

use Illuminate\Database\Seeder;
use App\Models\SocialLivingConditionList;

class SocialLivingConditionListSeeder extends Seeder
{
    protected $social_living_conditions = [
        ['name' => 'Անբավարար'],
        ['name' => 'Բավարար'],
        ['name' => 'Լավ'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->social_living_conditions as $social_living_condition) {
            SocialLivingConditionList::create($social_living_condition);
        }
    }
}
