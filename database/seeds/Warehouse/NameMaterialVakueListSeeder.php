<?php

use Illuminate\Database\Seeder;
use App\Models\MedicineList;
use Illuminate\Support\Facades\DB;

class NameMaterialVakueListSeeder extends Seeder
{

    public function run()
    {

        $filename=public_path('NMV');
        $d = scandir($filename, SCANDIR_SORT_NONE ); // get dir, without sorting improve performace (see Comment below).
        $xmlFile = simplexml_load_file(public_path('NMV/'.$d[2]));

        foreach ($xmlFile->Material as $NMV){
            DB::table('names_material_values')->insert([
                'code' =>$NMV->Code,
                'name' =>$NMV->Name,
                'unit' => $NMV->Unit,

            ]);
        }

    }
}
