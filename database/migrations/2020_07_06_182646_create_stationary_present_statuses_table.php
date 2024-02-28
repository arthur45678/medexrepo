<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateStationaryPresentStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_present_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("stationary_id");
            $table->unsignedBigInteger("user_id");

            $table->text('patient_general_condition')->nullable()->comment('Հիվանդի ընդհանուր վիճակը');
            $table->text('by_karnowski_scale')->nullable()->comment('ըստ Կարնովսկու սանդղակի');
            $table->text('consciousness')->nullable()->comment('գիտակցությունը');
            $table->string('position_in_bed')->nullable()->comment('արժեքները` PositionInBedEnum-ից');

            $table->string('skin_coverings')->nullable()->comment('մաշկածածկույթները. արժեքները` SkinCoveringsEnum-ից');
            $table->string('subcutaneous_fat')->nullable()->comment('ենթամաշկային ճարպաշերտը. արժեքները` SubcutaneousFatEnum-ից');
            // $table->unsignedTinyInteger('obesity')->nullable()->comment('ճարպակալում X աստիճան - թվային'); // calculated value
            $table->boolean('varicose_of_lower_extremities')->nullable()->comment('ստորին վեջույթների վարիկոզ լայնացում - տրամաբանական');
            $table->text('varicose_of_lower_extremities_comment')->nullable()->comment('ստորին վեջույթների վարիկոզ լայնացում - ազատ տեքստ');

            $table->boolean('peripheral_edema')->nullable()->comment('ծայրամասային այտուցներ - տրամաբանական');
            $table->text('peripheral_edema_comment')->nullable()->comment('ծայրամասային այտուցներ - ազատ տեքստ');

            $table->text('lymph_node')->nullable()->comment('ավշային հանգույցներ - ազատ տեքստ');
            $table->text('propulsion_system')->nullable()->comment('հենաշարժիչ համակարգ - ազատ տեքստ');
            $table->text('nervous_system')->nullable()->comment('նյարդային համակարգ - ազատ տեքստ');
            $table->text('breasts')->nullable()->comment('կրծքագեղձեր - ազատ տեքստ');

            // շնչառական համակարգ
            $table->text('respiratory_complaints')->nullable()->comment('շնչառական գանգատներ - ազատ տեքստ');
            $table->string('breathing_type')->nullable()->comment('շնչառությունը. արժեքները` - BreathingTypeEnum');
            $table->text('lung_collision')->nullable()->comment('թոքերի բախում - ազատ տեքստ');
            $table->text('listening_breathing')->nullable()->comment('լսում - ազատ տեքստ');
            $table->text('respiratory_movements_frequency_per_minute')->nullable()->comment('շնչառական շարժումների հաճախականությունը 1 րոպեյում - ազատ տեքստ');

            // սիրտ անոթային համակարգ
            $table->text('cardiovascular_complaints')->nullable()->comment('սիրտ-անոթային գանգատներ - ազատ տեքստ');
            $table->text('heart_percutaneous_border')->nullable()->comment('սրտի պերկուտոր սահմաններ - ազատ տեքստ');
            $table->text('heartbeat')->nullable()->comment('սրտի լսում - ազատ տեքստ');
            $table->text('vascular_stroke')->nullable()->comment('անոթազարկ - ազատ տեքստ');

            // $table->smallInteger('blood_pressure')->nullable()->comment('զարկերակային ճնշում -թվային');
            $table->smallInteger('blood_pressure_systolic')->nullable()->comment('զարկերակային ճնշում - սրտամկանի կծկված - թվային');
            $table->smallInteger('blood_pressure_diastolic')->nullable()->comment('զարկերակային ճնշում - սրտամկանի թուլացած -թվային');

            $table->text('endocrine_system')->nullable()->comment('էնդոկրին համակարգ - ազատ տեքստ');

            $table->text('lor_organs')->nullable()->comment('LOR օրգաններ - ազատ տեքստ');

            // մարսողական համակարգ
            $table->text('digestive_complaints')->nullable()->comment('մարսողական գանգատներ - ազատ տեքստ');
            $table->string('tongue_state')->nullable()->comment('լեզուն. արժեքները` - TongueStateEnum');
            $table->string('act_of_absorption')->nullable()->comment('կլման ակտը. արժեքները` - AbsorptionActEnum');
            $table->text('absorption_difficulty_degree')->nullable()->comment('կլման ակտի դժվարության աստիճանը` - ազատ տեքստ');

            $table->boolean('abdomen_is_symmetrical')->nullable()->comment('որովայնը համաչափ է` - տրամաբանական');
            $table->boolean('abdomen_is_involved_in_breathing')->nullable()->comment('որովայնը շնչառությանը մասնակցում է` - տրամաբանական');
            // $table->boolean('pain_when_touching_abdomen')->nullable()->comment('ցավոտություն որովայնը շոշափելիս` - տրամաբանական');
            $table->text('pain_when_touching_abdomen_comment')->nullable()->comment('ցավոտություն որովայնը շոշափելիս` - ազատ դաշտ');

            // 5-th page
            $table->string('abdominal_urinary_symptom')->nullable()->comment('որովայնամիզային ախտանշանները` - AbdominalUrinarySymptomEnum');
            $table->text('abdominal_urinary_symptom_comment')->nullable()->comment('որովայնամիզային ախտանշանները` - ազատ դաշտ');

            $table->boolean('liver_is_enlarged')->nullable()->comment('լյարդը` մեծացած է|մեծացած չէ');
            $table->unsignedTinyInteger('liver_size')->nullable()->comment('լյարդը` X սմ');
            $table->string('liver_type')->nullable()->comment('(լյարդը շոշափելիս) - LiverAndSpleenTypeEnum');

            $table->boolean('spleen_is_enlarged')->nullable()->comment('փայծախը` մեծացած է|մեծացած չէ');
            $table->unsignedTinyInteger('spleen_size')->nullable()->comment('փայծախը` X սմ');
            $table->string('spleen_type')->nullable()->comment('(փայծախը շոշափելիս) - LiverAndSpleenTypeEnum');

            $table->string('intestinal_peristalsis')->nullable()->comment('աղիքային պերիստալտիկան - IntestinalPeristalsisEnum');

            // Միզասեռական համակարգ՝
            $table->text('urogenital_complaints')->nullable()->comment('Միզասեռական գանգատներ` - ազատ դաշտ');
            $table->string('urination_type')->nullable()->comment('միզարձակումը` - UrinationTypeEnum');
            $table->boolean('symptom_of_urogenital_distribution')->nullable()->comment('Միզասեռական բաշխման ախտանշանը` - տրամաբանական: բացասական|դրական');
            $table->string('symptom_of_urogenital_distribution_comment')->nullable()->comment('Միզասեռական բաշխման ախտանշանը` - ազատ դաշտ');

            $table->text('status_localis')->nullable()->comment('Status localis - ազատ դաշտ');

            // Նախնական ախտորոշում՝ -> StationaryDiagnosisEnum, type -> stationary_present_status_preliminary

            // $table->json('examination_program')->nullable()->default(new Expression('(JSON_ARRAY())'))->comment('հետազոտության ծրագիր - json list of ToDos');
            $table->json('examination_program')->nullable()->default(null)->comment('հետազոտության ծրագիր - json list of ToDos');


            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stationary_present_statuses');
    }
}
