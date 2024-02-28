<?php

use Illuminate\Database\Seeder;
use App\Models\CancerGroup;

class CancerGroupSeeder extends Seeder
{
    public $cancer_groups = [
        'I ա',
        'I բ',
        'II ա',
        'II բ',
        'III',
        'IV',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cancer_groups as $key => $c_group) {
            CancerGroup::create(['regular_id'=>($key+1), 'name'=>$c_group]);
        }

    }
}
