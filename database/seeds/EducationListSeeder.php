<?php

use Illuminate\Database\Seeder;
use App\Models\EducationList;

class EducationListSeeder extends Seeder
{
    protected $educations = [
        ['name' => 'Տարրական'],
        ['name' => 'Միջնակարգ'],
        ['name' => 'Միջին մասնգիտական'],
        ['name' => 'Բարձրագույն'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->educations as $education) {
            EducationList::create($education);
        }
    }
}
