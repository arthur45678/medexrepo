<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path('UserSedder');
        $d = scandir($filename, SCANDIR_SORT_NONE);
        $content = file_get_contents(public_path('UserSedder/' . $d[2]));
        $arrContent = json_decode($content, true);
        foreach ($arrContent as $user) {
                \Illuminate\Support\Facades\DB::table('users')->insert($user);
        }
}
//public function run()
//    {
//        $filename=public_path('UserSedder_old');
//        $d = scandir($filename, SCANDIR_SORT_NONE );
//        $content = file_get_contents(public_path('UserSedder_old/'.$d[2]));
//        $arrContent = json_decode($content, true);
//
//
//        foreach ($arrContent as  $arrContents) {
//            $name=explode(' ',$arrContents['name']);
//            $departament=\App\Models\Department::where('code',$arrContents['department_code'])->first();
//            if ($departament!=null):
//            \Illuminate\Support\Facades\DB::table('users')->insert([
//                "f_name" =>$name[1] ?? 'անուն',
//                "l_name" => $name[0] ?? 'ազգանուն',
//                "p_name" =>$name[2] ?? 'Հայրանուն',
//                "username" => 'medex_'.$arrContents['document_number'] ?? 'L'.$arrContents['settlement_account'],
//                "password" => Hash::make("password"),
//                "department_id" => $departament->id ?? null,
//                "department_code" => $arrContents['department_code'] ?? 0,
//                "position" => $arrContents['position'] ?? null,
//            ]);
//            endif:
//        }
//           }
}
