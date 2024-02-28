<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdministrativeStaff;
class AdministrativeDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $staffs = [
        0 =>
            array(
                'title' => 'Փոխտնօրեն ընդհանուր հարցերով',
                'type' => 'v-pills-home',
                'departments' => []
            ),
        1 =>
            array(
                'title' => 'Փոխտնօրեն դիսպանսեր և պոլիկլինիկական գծով',
                'type' => 'v-pills-profile',
                'departments' => [32,45]
            ),
        2 =>
            array(
                'title' => 'Փոխտնօրեն բուժական գծով',
                'type' => 'v-pills-messages',
                'departments' => [2,1,9,3,5]
            ),
        3 =>
            array(
                'title' => 'Գլխավոր բժիշկ',
                'type' => 'v-pills-settings',
                'departments' => [41,43,44]
            ),
        4 =>
            array(
                'title' => 'Տնօրենի խորհրդական ֆինանսական գծով',
                'type' => 'v-pills-set',
                'departments' => [34,42]
            ),
    ];

    public function run()
    {
        foreach ($this->staffs as $ad){
            $sraff = AdministrativeStaff::create(['title' => $ad['title'], 'type'=>$ad['type']]);
            $sraff->departments()->attach($ad['departments']);
        }
    }
}
