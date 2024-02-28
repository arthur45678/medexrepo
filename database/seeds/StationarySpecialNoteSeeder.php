<?php

use Illuminate\Database\Seeder;
use App\Models\Stationary;

class StationarySpecialNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();
        $special_note = $stationary->stationary_special_note()->create([
            'special_note_date' => now(),
            'special_note_comment' => 'Multiple select list (hold ctrl or shift (or drag with the mouse) to select more than one)'
        ]);

        $special_note->attachments()->create([
            "attachment_name" => "special_note.png"
        ]);
    }
}
