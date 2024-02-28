<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmunologicalExaminationPatternN4STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunological_examination_pattern_n4_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('research');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('ambulator_id')->nullable()->comment('Ամբուլատոր բժշկական քարտի №');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('specialist')->nullable()->comment('Ուղեգրող բժիշկ');
            $table->unsignedBigInteger('attending_doctor')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');
            $table->integer('hospital_room_number')->nullable()->comment('Հիվանդասենյակի համարը');
            $table->integer("stationary_id")->nullable()->comment('Հիվանդության պատմագրի №');
            $table->timestamp('date')->comment('Կենսանյութը վերցնելու ամսաթիվ');
//         ՎԻՐՈՒՍԱՅԻՆ ԻՆՖԵԿՑԻԱՆԵՐԻ ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ

            $table->string('TTG')->nullable()->comment('TTG /Թիրեոտրոպին/ - Նորմա - 0,27-4,2_մIՍ/mL');
            $table->string('T3')->nullable()->comment('T3 /Եռյոդթիրոնին ընդհանուր/ - Նորմա - 1,2-3,16__պկմ/լ');
            $table->string('F_T3')->nullable()->comment('F T3 /Եռյոդթիրոնին ազատ/ - Նորմա - 4,4-9,3 պկմ/լ');
            $table->string('T4')->nullable()->comment('T4 /Թիրոքսին ընդհանուր/ - Նորմա - 60-165 նմ/լ');
            $table->string('F_T4')->nullable()->comment('F T4 /Թիրոքսին ազատ/ - Նորմա - 10-24 պկմ/լ');
            $table->string('TG')->nullable()->comment('TG /Թիրեոգլոբուլին/ - Նորմա - 0-50նգ/մլ');
            $table->string('Aոti_TG')->nullable()->comment('Aոti TG /հակաթիրեոգլոբուլին հակամարմիններ/ - Նորմա - 0-40 մմ/մլ');
            $table->string('Aոti_TPO')->nullable()->comment('Aոti TPO /հակաթիրեոիդպերօքսիդազ հակամարմիններ/ - Նորմա - <35մմ/մլ');
            $table->string('CTN')->nullable()->comment('CTN /Կալցիտոնին/ - Նորմա - 5,5-28 պկմ/լլ');
            $table->string('PTH')->nullable()->comment('PTH /պարատ հորմոն/ - Նորմա - 15,0-65,0 պգ/մլ');
            $table->longText('research_done')->nullable()->comment('Հետազոտությունը կատարվել է');
            $table->timestamp('date_research')->nullable()->comment('ԻՄՈՒՆԱԲԱՆԱԿԱՆ հետազոտության պատասխանի ամսաթիվ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('specialist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('immunological_examination_pattern_n4_s');
    }
}
