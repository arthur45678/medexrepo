<?php

use Illuminate\Database\Seeder;

use App\Models\Stationary;

class StationaryUltrasoundEndoscopySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::all()->first();

        $stationary->stationary_ultrasound_endoscopies()->create([
            "examination_comment" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam distinctio amet nostrum repudiandae non nobis illo. Doloribus ab, vitae laboriosam consectetur tempore, iusto blanditiis sed ea architecto voluptas pariatur nobis!",
            "examination_date" => now(),
        ]);
    }
}
