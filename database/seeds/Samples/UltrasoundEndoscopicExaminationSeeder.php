<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\UltrasoundEndoscopicExamination;
use App\Models\User;

class UltrasoundEndoscopicExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ultrasoud_endoscopy_examination = UltrasoundEndoscopicExamination::create([
            // 'user_id' => 1,
            'patient_id' => 1,
            'attending_doctor_id' => 2,
            'research_type' => 'Հոտազոտության տեսակ - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'description_comment' => 'Նկարագիր - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'conclusion_comment' => 'Եզարակացություն - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'recommended_comment' => 'Խորհուրդ է տրվում - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'date' => now(),
        ]);

        $ultrasoud_endoscopy_examination->approvement()->create(["department_id" => 1, "status" => 0]);

        $doc = User::where('username', 's.simonyan')->first();

        $ultrasoud_endoscopy_examination2 = UltrasoundEndoscopicExamination::create([
            'patient_id' => 1,
            'attending_doctor_id' => $doc->id,
            'research_type' => '22222222222222 Հոտազոտության տեսակ - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'description_comment' => '22222222222 Նկարագիր - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'conclusion_comment' => '22222222222 Եզարակացություն - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'recommended_comment' => '22222222222 Խորհուրդ է տրվում - Էնդոսկոպիկ ուլտրաձայնային հետազոտություն',
            'date' => now(),
        ]);

        $ultrasoud_endoscopy_examination2->approvement()->create(["department_id" => 1, "status" => 1]);
    }
}
