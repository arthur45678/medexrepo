<?php

namespace App\Http\Controllers\Armed;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class IndexController extends Controller
{

    public function index()
    {
        return 'this route is not work';
        // $now = now()->format('Y-m-d_H-i-s');
        // Storage::put("/logs/{$now}_armed_patient.txt", 'Index was opened');
    }
    public function store_patient(Request $request)
    {
        $now = now()->format('Y-m-d_H-i-s');
        $dataPOST = trim(file_get_contents('php://input'));
        $xmlData = simplexml_load_string($dataPOST);

        Storage::put("/logs/{$now}_patient_request_headers.txt", $request);
        Storage::put("/logs/{$now}_patient_request_all.txt", $request->all());
        Storage::put("/logs/{$now}_patient_request_dataPOST.txt", $dataPOST);
        Storage::put("/logs/{$now}_patient_xml.txt", $xmlData->saveXML());
        // return response()->json(['data' => 'koko']);
        return $xmlData->saveXML();
    }

    public function insert_patient()
    {
        /**
         * 'ambulance_call_example_cda.xml'
         * --------------------------------
         * 'dummy_patient_example.xml'
         * 'filled_patient_example.xml'
         */
        $file_name = 'ambulance_call_example_cda.xml';
        $patient = Storage::get("/logs/{$file_name}");
        // dump($patient);
        // echo gettype($patient); // string
        $patient_xml = new SimpleXMLElement($patient); // նույնն է ինչ store_patient()-ի $xmlData
        dump($patient_xml);
        $patientRole = $patient_xml->recordTarget->patientRole;
        $patient_names = $patientRole->patient->name;

        $f_name = self::not_dummy($patient_names->given) ? $patient_names->given : null;
        $l_name = self::not_dummy($patient_names->family) ? $patient_names->family : null;
        $p_name = self::not_dummy($patient_names->patronymic) ? $patient_names->patronymic : null;
        dump($patient_names);
        dump($f_name);
        dump($l_name);
        dump($p_name);

        $gender_code = self::not_dummy($patient_xml->recordTarget->patientRole->patient->administrativeGenderCode['code']) ?
            $patient_xml->recordTarget->patientRole->patient->administrativeGenderCode['code'] : null; // 1=male, 2=female
        dump($gender_code);

        $birth_time_string = self::not_dummy($patient_xml->recordTarget->patientRole->patient->birthTime['value']) ?
            $patient_xml->recordTarget->patientRole->patient->birthTime['value'] : null;
        $birth_date_string = $birth_time_string ? date("Y-m-d", strtotime($birth_time_string)) : null;
        dump($birth_date_string);

        $patient_id0 = $patientRole->id[0]; // 1.2.398.7.1.3.1 extension-> soc. card
        $patient_id1 = $patientRole->id[1]; // root -> passport
        $patient_id2 = $patientRole->id[2]; // extension-> foreign passport
        $patient_id3 = $patientRole->id[3]; // extension-> temporary passport
        $patient_id4 = $patientRole->id[4]; // extension-> newborn passport
        dump($patient_id0);
        dump($patient_id1);
        dump($patient_id2);
        dump($patient_id3);
        dump($patient_id4);

        if (
            $patient_id0 &&
            $patient_id0['root'] &&
            $patient_id0['root'] == '1.2.398.7.1.3.1' &&
            self::not_dummy($patient_id0['extension'])
        ) {
            // dump($patient_id0['extension']);
            // dump(self::not_dummy($patient_id0['extension']));
            /**
             * 1) check patient exists with current iin (soc. card)
             * 2) if exists - update patient
             * 3) if not exist - create patient
             * 4) armed - if $patient_id1 $patient_id2 $patient_id3 $patient_id4 - all used, prepare code, to save that as passport
             */

            // 1)
            $soc_card = $patient_id0['extension'];
            $patient = Patient::where('soc_card', $soc_card)->first();
            // $patient = Patient::where('soc_card', '2000000788')->first();
            if($patient) {
                // update - f_name, l_name, p_name, gender_code, birth_date_string
                dump('update');
                dump($patient);
                if($f_name) $patient->f_name = $f_name;
                if($l_name) $patient->l_name = $l_name;
                if($p_name) $patient->p_name = $p_name;

                if($gender_code && $gender_code == 2) $patient->is_male = 0;
                if($gender_code && $gender_code == 1) $patient->is_male = 1;
                if($birth_date_string) $patient->birth_date = $birth_date_string;
                $patient->save();

                dump('updated');
            }else{
                // insert - f_name, l_name, p_name, gender_code, birth_date_string
                dump('create');
                dump($patient);
                $new_patient = new Patient([
                    'soc_card' => $soc_card
                ]);

                if($f_name) $new_patient->f_name = $f_name;
                if($l_name) $new_patient->l_name = $l_name;
                if($p_name) $new_patient->p_name = $p_name;

                if($gender_code && $gender_code == 2) $new_patient->is_male = 0;
                if($gender_code && $gender_code == 1) $new_patient->is_male = 1;
                if($birth_date_string) $new_patient->birth_date = $birth_date_string;
                $new_patient->save();
                dump('created');
            }
        } else {
            dd('patient_iin is not set'); // after replace with Log - to log to file
        }
    }

    public static function not_dummy(string  $field)
    {
        return !str_contains($field, 'sylex:');
    }

    public function create_patient()
    {
        return view('armed.create_patient');
    }
}
