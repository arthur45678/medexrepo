<?php


use Illuminate\Database\Seeder;
use App\Models\StationarySocialPackage;
use App\Models\Stationary;
use App\Models\User;

class StationarySocialPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stationary = Stationary::first();
        $simon = User::where('username','=', 's.simonyan')->first();

        StationarySocialPackage::create([
            'user_id' => $simon->id,
            'stationary_id' => $stationary->id,
            'social_package_id' => 1
        ]);

        StationarySocialPackage::create([
            'user_id' => $simon->id,
            'stationary_id' => $stationary->id,
            'social_package_id' => 2
        ]);
    }
}
