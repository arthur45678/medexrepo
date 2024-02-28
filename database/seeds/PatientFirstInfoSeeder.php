<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\PatientFirstInfo;
use Faker\Generator as Faker;

class PatientFirstInfoSeeder extends Seeder
{
    public $treatments = 'Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ տեքստի ձևավորման վրա: Lorem Ipsum օգտագործելը բացատրվում է նրանով, որ այն բաշխում է բառերը քիչ թե շատ իրականի նման, ի տարբերություն «Բովանդակություն, բովանդակություն» սովորական կրկննության, ինչը ընթերցողի համար հասկանալի է: Շատ համակարգչային տպագրական ծրագրեր և ինտերնետային էջերի խմբագրիչներ այն օգտագործում են որպես իրենց ստանդարտ տեքստային մոդել, և հետևապես, ինտերնետում Lorem Ipsum-ի որոնման արդյունքում կարելի է հայտնաբերել էջեր, որոնք դեռ նոր են կերտվում: Ժամանակի ընթացքում ձևավորվել են Lorem Ipsum-ի տարբեր վերսիաներ` երբեմն ներառելով պատահական տեքստեր, երբեմն էլ հատուկ իմաստ (հումոր և նմանատիպ բովանդակություն):';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        PatientFirstInfo::create([
            'patient_id'=> Patient::first()->id,
            'first_clinic'=> Clinic::first()->id,
            'first_clinic_date' => date('Y-m-d', strtotime('1988-02-02')),
            'first_discovered'=>Clinic::find(2)->id,
            'first_discovered_date' => date('Y-m-d', strtotime('1990-05-23')),
            // 'past_treatments'=> $faker->text($maxNbChars = 500),
            'past_treatments'=> $this->treatments,
        ]);

    }
}
