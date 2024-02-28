<?php

use Illuminate\Database\Seeder;
use App\Models\RegistrationOptionList;

class RegistrationOptionListSeeder extends Seeder
{
    protected $registration_options = [
        ['name' => 'Առաջին անգամ ախտորոշված (հաշվետու տարում)'],
        ['name' => 'Նախկինում հաստատված ախտորոշմամբ'],
        ['name' => 'Հետմահու (կենդանության օրոք հաստատված)'],
        ['name' => 'Հետմահու (մահից հետո հաստատված ախտորոշմամբ՝ առանց հերձման)'],
        ['name' => 'Հետմահու (մահից հետո հաստատված ախտորոշմամբ՝ հերձումով)']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->registration_options as $registration_option) {
            RegistrationOptionList::create($registration_option);
        }
    }
}
