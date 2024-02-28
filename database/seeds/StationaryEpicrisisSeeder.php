<?php

use App\Models\Stationary;
use Illuminate\Database\Seeder;
use App\Models\User;

class StationaryEpicrisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();

        $doc = User::where('username', 's.simonyan')->first();
        $dep_head =  User::where('username', 'armen.nikoghosyan')->first();
        $user_outpatient_dispensary_and_reception_deputy_director = User::where('username', 'gagik.bazikyan')->first();

        $stationary_epicrisis = $stationary->stationary_epicrisis()->create([
            "attending_doctor_id" => $doc->id,
            "department_head_id" => $dep_head->id,
            "chief_doctor_id" => $user_outpatient_dispensary_and_reception_deputy_director->id,
            "epicrisis_date" => now(),
            "epicrisis" => "Lorem Ipsum Dolor Sit Amet"
        ]);

        $stationary_epicrisis->attachments()->create([
            "attachment_name" => "lorem.png"
        ]);

        $stationary_epicrisis->attachments()->create([
            "attachment_name" => "lorem ipsum.pdf"
        ]);

        $stationary_epicrisis->attachments()->create([
            "attachment_name" => "some interesting file with longer name.docx"
        ]);

        $stationary_epicrisis->attachments()->create([
            "attachment_name" => "1849395050.jpg"
        ]);
    }
}
