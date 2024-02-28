<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = array(
            array(
                'f_name' => 'Սերո',
                'l_name' => 'Խանզադյան',
                'p_name' => 'Խորենի',
                'residence_region' => 'Կոտայք',
                'town_village' => 'Ք․ Աբովյան',
                'street_house' => 'Գարեգին Նժդեհի 45',
                'workplace' => 'Այստեղ ՍՊԸ',
                'profession' => 'սպասարկող',
                'birth_date' => date('Y-m-d', strtotime('02-04-1966')),
                'passport' => 'АМ01234567',
                'soc_card' => '2000000123',
                'nationality' => 'հայ',
                // 'sex' => 'տղամարդ',
                'is_male' => true,
                'm_phone' => '091123456',
                'c_phone' => '010123456',
                'email' => 'sero.xanzadyan@gmail.com',
                'blood_group' => 2,
                'rh_factor' => false,

                'residence_region_residence' => 'Երևան',
                'town_village_residence' => 'Ք․ Երևան',
                'street_house_residence' => 'Գարեգին Նժդեհի 15',

                'living_place_id' => 1,
                'citizenship' => 'ՀՀ պատվավոր քաղաքացի',

                'social_living_condition_id' => 2,
                'working_feature_id' => 3,
                'education_id' => 4,
                'marital_status_id' => 1

            ),
            array(
                'f_name' => 'Դանիել',
                'l_name' => 'Վարուժան',
                'p_name' => 'Վարուժի',
                'residence_region' => 'Կոտայքի մարզ',
                'town_village' => 'Գ․ Քանաքեռավան',
                'street_house' => 'Գ․ Մահարի, տուն 22',
                'workplace' => 'Կաթի գործարան ՓԲԸ',
                'profession' => 'բանվոր',
                'birth_date' => date('Y-m-d', strtotime('1975-04-11')),
                'passport' => 'АМ07891011',
                'soc_card' => '2000000789',
                'nationality' => 'հայ',
                'is_male' => true,
                // 'sex' => 'տղամարդ',
                'm_phone' => '091789101',
                'c_phone' => '010789101',
                'email' => 'daniel.varujan@gmail.com',
                'blood_group' => 3,
                'rh_factor' => true,

                'residence_region_residence' => 'Երևան',
                'town_village_residence' => 'Ք․ Երևան',
                'street_house_residence' => 'Աջափնյակ, Աղբյուր Սերոբի 15',

                'living_place_id' => 2,
                'citizenship' => 'ՀՀ պատվավոր քաղաքացի',

                'social_living_condition_id' => 3,
                'working_feature_id' => 4,
                'education_id' => 3,
                'marital_status_id' => 2
            ),
            array(
                'f_name' => 'Սիլվա',
                'l_name' => 'Կապուտիկյան',
                'p_name' => 'Բարունակի',
                'residence_region' => 'Վայոց ձոր',
                'town_village' => 'Ք․ Եղեգնաձոր',
                'street_house' => 'Մ․ Սարյան, 22շ․ բն․ 12',
                'workplace' => 'Գինու գործարան ՓԲԸ',
                'profession' => 'գինեգործ',
                'birth_date' => date('Y-m-d', strtotime('1935-11-15')),
                'passport' => 'АМ07897777',
                'soc_card' => '2000000787',
                'nationality' => 'հայ',
                'is_male' => false,
                // 'sex' => 'կին',
                'm_phone' => '091334433',
                'c_phone' => '010334433',
                'email' => 'silva.kaputikyan@gmail.com',
                'blood_group' => 1,
                'rh_factor' => false,

                # for cancer_patient_control-card START
                'residence_region_residence' => 'Երևան',
                'town_village_residence' => 'Ք․ Երևան',
                'street_house_residence' => 'Ավան, Բաբաջանյան 95',

                'citizenship' => 'ՀՀ պատվավոր քաղաքացի',

                'living_place_id' => 1,
                'social_living_condition_id' => 2,
                'working_feature_id' => 8,
                'education_id' => 1,
                'marital_status_id' => 3
                # for cancer_patient_control-card END
            ),
            array(
                'f_name' => 'Հովհաննես',
                'l_name' => 'Շիրազ',
                'p_name' => 'Թադևոսի',
                'residence_region' => 'Վայոց ձոր',
                'town_village' => 'Գ․ Մալիշկա',
                'street_house' => 'Մ․ Սարյան, 22շ․ բն․ 12',
                'workplace' => 'Գինու գործարան ՓԲԸ',
                'profession' => 'գինեգործ',
                'birth_date' => date('Y-m-d', strtotime('1935-11-15')),
                'passport' => 'АМ07898686',
                'soc_card' => '2000000788',
                'nationality' => 'հայ',
                'is_male' => false,
                // 'sex' => 'տղամարդ',
                'm_phone' => '091334433',
                'c_phone' => '010334433',
                'email' => 'hovh.shiraz@gmail.com',
                'blood_group' => 2,
                'rh_factor' => false,

                'residence_region_residence' => 'Երևան',
                'town_village_residence' => 'Ք․ Երևան',
                'street_house_residence' => 'Սեբաստիա, Կյուրեղյան 88',

                'living_place_id' => 2,
                'citizenship' => 'ՀՀ պատվավոր քաղաքացի',

                'social_living_condition_id' => 3,
                'working_feature_id' => 6,
                'education_id' => 2,
                'marital_status_id' => 2
            )
        );
        foreach ($patients as $key => $patient) {
            Patient::create($patient);
        }
    }
}
