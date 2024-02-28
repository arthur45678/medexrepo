<?php

use Illuminate\Database\Seeder;
use App\Models\Samples\AnesthesiologistPreSurgeryExamination;

class AnesthesiologistPreSurgeryExaminationSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $anesthesiology_presurgery_examination = AnesthesiologistPreSurgeryExamination::create([
            'patient_id' => 1,
            'attending_doctor_id' => 1,
            'anesthesia_id' => 1,
            'date' => now(),
            'body_structure' => 'մարմնի կառուցվածքը - ազատ դաշտ',
            'weight' => 'քաշը - ազատ դաշտ',
            'complaints' => 'գանգատները - ազատ դաշտ',
            'consciousness' => 'Գիտակցությունը - ազատ դաշտ',
            'the_skin' => 'Մաշկը և տես. լորձաթաղ - ազատ դաշտ',
            'cardiovascular_system' => 'Սիրտանոթային համակարգ՝ ԱՃ՝ - ազատ դաշտ',
            'heart_contraction' => 'Սրտի կծկ. հաճախ.՝ զ/ր - ազատ դաշտ',
            'auscultation' =>'Աուսկուլտացիա - ազատ դաշտ',
            'veins' => 'էՍԳ՝, երակներ՝ - ազատ դաշտ',
            'respiratory_system' => 'Շնչական համակարգ՝, շնչ. հաճ.՝ - ազատ դաշտ',
            'oral' => 'Բերանի խոռոչ - option - ազատ դաշտ',
            'mallampati' => 1,
            'other_organ_systems' => 'Այլ օրգան համակարգեր - ազատ դաշտ',
            'laboratory_tests' => 'Լաբորատոր հետազոտություններ` - ազատ դաշտ',
            'allergic' => 'Ալերգիկ՝ - ազատ դաշտ',
            'surgical' => 'Վիրաբուժական - ազատ դաշտ',
            'ASA' => 2,
            'special_notes' => 'Հատուկ նշումներ՝ - ազատ դաշտ',
            'patient_guardian_relative' => 'Հիվանդ/խնամակալ/ ազգական՝',
        ]);
    }
}
