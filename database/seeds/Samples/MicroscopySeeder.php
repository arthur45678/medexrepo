<?php
use Illuminate\Database\Seeder;
use App\Models\Samples\Microscopy;

class MicroscopySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $microscopy = Microscopy::create([
            // 'user_id' => 1,
            'patient_id' => 1,
            'attending_doctor_id' => 2,
            'flat' => 'տափակ' ,
            'transient' => 'անցողային',
            'renal' => 'երիկամային',
            'leukocytes' => 'լեյկոցիտներ',
            'erythrocytes' => 'էրիտրոցիտներ',
            'resume' => 'ամփոփոխ',
            'changed' => 'փոփոխված',
            'cylinders' => 'ցիլինդրներ',
            'hyaline' => 'հիալինային',
            'candle' => 'մոմաձև',
            'granular' => 'հատիկավոր',
            'epithelial' => 'էպիթելային',
            'leukocyte' => 'լեյկոցիտար',
            'erythrocyte' => 'էրիթրոցիտար',
            'pigment' => 'պիգմենտային',
            'mucus' => 'լորձ',
            'salt' => 'աղ',
            'bacteria' => 'բակտերիաներ',
            'analisis_date' => now(),

        ]);
    }
}
