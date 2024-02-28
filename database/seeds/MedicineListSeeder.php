<?php

use Illuminate\Database\Seeder;
use App\Models\MedicineList;
use Illuminate\Support\Facades\DB;

class MedicineListSeeder extends Seeder
{

    public function run()
    {
        $xmlFile = simplexml_load_file(public_path('MedicineListSedder/medicine.xml'));
        $xmlFile_humanitarian = simplexml_load_file(public_path('MedicineListSedder/humanitarian.xml'));

        foreach ($xmlFile->Material as $medicineList){
            $medicine=DB::table('medicine_lists')->insert([
                'code' =>$medicineList->Code,
                'name' =>$medicineList->Name,
                'unit' => $medicineList->Unit,
                'warehouse' => $medicineList->Group,
            ]);
        }
        foreach ($xmlFile_humanitarian->Material as $humanitarianmedicineList){
            $medicine=DB::table('medicine_lists')->insert([
                'code' =>$humanitarianmedicineList->Code,
                'name' =>$humanitarianmedicineList->Name,
                'unit' => $humanitarianmedicineList->Unit,
                'warehouse' => $humanitarianmedicineList->Group,
            ]);

        }
    }
}
