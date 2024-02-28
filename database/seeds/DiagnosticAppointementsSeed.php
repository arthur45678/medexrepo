<?php

use Illuminate\Database\Seeder;
use App\Models\diagnostic\DiagnosticAppointmentModels;
class DiagnosticAppointementsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DiagnosticAppointmentModels::create([
            'id' => 1,
            'name' => 'Արյան ընդհանուր քննություն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 2,
            'name' => 'Մեզի ընդհանուր քննություն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 3,
            'name' => 'Արյան բիոքիմիական քննություն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 4,
            'name' => 'Էլեկտրոսրտագրություն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 5,
            'name' => 'Թոքերի ռենտգենյան քննություն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 6,
            'name' => 'Արյան խումբ և ռեզուս գործոն',
        ]);
        DiagnosticAppointmentModels::create([
            'id' => 7,
            'name' => 'Ուլտրաձայնային հետազոտություն',
        ]);



    }
}
