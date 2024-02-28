<?php

use Illuminate\Database\Seeder;
use App\Models\OncomarkerList;

class OncomarkerListSeeder extends Seeder
{
    protected $oncomarker_lists = [
        ['name' => 'CEA ng/ml'],
        ['name' => 'Ca-19-9 U/ml'],
        ['name' => 'Ca-15-3'],
        ['name' => 'PSA total'],
        ['name' => 'PSA Free'],
        ['name' => 'Ratio PSA total/PSA Free'],
        ['name' => 'AFP'],
        ['name' => 'hCG'],
        ['name' => 'SCC'],
        ['name' => 'NSE'],
        ['name' => 'HE-4'],
        ['name' => 'Ca-125'],
        ['name' => 'ROMA SCORE'],
        ['name' => 'Այլ'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->oncomarker_lists as $oncomarker) {
            OncomarkerList::create($oncomarker);
        }
    }
}
