<?php

use Illuminate\Database\Seeder;
use App\Models\AgeList;

class AgeListSeeder extends Seeder
{
    private $age_list = [
        ['age_code' => 1, 'age_from' => 0, 'age_to' => 4],
        ['age_code' => 2, 'age_from' => 5, 'age_to' => 9],
        ['age_code' => 3, 'age_from' => 10, 'age_to' => 14],
        ['age_code' => 4, 'age_from' => 15, 'age_to' => 17],
        ['age_code' => 5, 'age_from' => 18, 'age_to' => 19],
        ['age_code' => 6, 'age_from' => 20, 'age_to' => 24],
        ['age_code' => 7, 'age_from' => 25, 'age_to' => 29],
        ['age_code' => 8, 'age_from' => 30, 'age_to' => 34],
        ['age_code' => 9, 'age_from' => 35, 'age_to' => 39],
        ['age_code' => 10, 'age_from' => 40, 'age_to' => 44],
        ['age_code' => 11, 'age_from' => 45, 'age_to' => 49],
        ['age_code' => 12, 'age_from' => 50, 'age_to' => 54],
        ['age_code' => 13, 'age_from' => 55, 'age_to' => 59],
        ['age_code' => 14, 'age_from' => 60, 'age_to' => 64],
        ['age_code' => 15, 'age_from' => 65, 'age_to' => 69],
        ['age_code' => 16, 'age_from' => 70, 'age_to' => 74],
        ['age_code' => 17, 'age_from' => 75, 'age_to' => 79],
        ['age_code' => 18, 'age_from' => 80, 'age_to' => 84],
        ['age_code' => 19, 'age_from' => 85, 'age_to' => 200],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->age_list as $age) {
            AgeList::create($age);
        }
    }
}
