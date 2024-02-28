<?php

use Illuminate\Database\Seeder;

use App\Models\Stationary;
use App\Models\User;

class StationarySurgeryJustificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $doc = User::where('username', 's.simonyan')->first();
        $dep_head =  User::where('username', 'armen.nikoghosyan')->first();
        $mad_director =  User::where('username', 'aram.jilavyan')->first(); // Տնօրենի տեղակալ բուժական գծով

        $stationary->stationary_surgery_justifications()->create([
            "justification" => "Lorem Ipsum Dolor Sit Amet",
            "date" => now(),
            "attending_doctor_id" => $doc->id,
            "department_head_id" => $dep_head->id,
            "medical_affairs_deputy_director_id" => $mad_director->id
        ]);
    }
}
