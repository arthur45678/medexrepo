<?php

use App\Models\AnesthesiaList;
use Illuminate\Database\Seeder;

class AnesthesiaListSeeder extends Seeder
{
    private $anesthesias = [
        "Ընդհանուր անզգայացում",
        "Էպիդուրալ անզգայացում",
        "Ողնուղեղային անզգայացում",
        "Տեղային անզգայացում",
        "Կոմբինացված",
        "Ներերակային սեդացիա",
        "Տոտալ ներերակային անզգայացում"
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->anesthesias as $anesthesia) {
            AnesthesiaList::create(["name" => $anesthesia]);
        }
    }
}
