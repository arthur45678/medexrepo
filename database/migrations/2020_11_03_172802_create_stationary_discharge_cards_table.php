<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryDischargeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_discharge_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger("department_id");
            $table->integer("stationary_id");
            $table->longText('sent_patient')->nullable()->comment('Ում կողմից է ուղարկված հիվանդը');
            $table->longText('bed_profiles')->nullable()->comment('Մահճակալների պռոֆիլները');
            $table->enum('accept',['yes','no'])->nullable()->comment('Ստացիանար է ընդունվել անհետաձգելի ցուցումով');
            $table->enum('from_injury',['in_the_first_6_hours','7_24_hours_later','No_later_than_24_hours'])->nullable()->comment('Հիվանդության սկզբից(վնասվածք ստանալուց)քանի ժամ անց');
            $table->timestamp('research_date')->nullable()->comment('Ստացիոնար ընդունվելու ամսաթիվ');
            $table->enum('outcome_of_the_disease',['discharged','died','moved'])->nullable()->comment('Հիվանդության Ելքը');
            $table->timestamp('date_discharge_or_death')->nullable()->comment('Դուրս գրման(մահվան) ամսաթիվը');
            $table->longText('research')->nullable()->comment('Անցկացրել է (մ/օր)');
            $table->longText('sent_diagnosis_facility')->nullable()->comment('Ուղարկված հաստատության ախտորոշումը');
            $table->enum('hospitalized',['first_time','double'])->nullable()->comment('Տվյալ տարում տվյալ հիվանդության կապակցությամբ հոսպիտալացվել է');
//            Մահվան դեպքում նշել պատճառը
            $table->longText('died_a_comment')->nullable()->comment('1․ ա/ Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)');
            $table->longText('died_b_comment')->nullable()->comment('բ/ Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)');
            $table->longText('died_c_comment')->nullable()->comment('գ/Հիմնական հիվանդություն');
            $table->longText('died_d_comment')->nullable()->comment('2/ Ուրիշ կարևոր հիվանդություններ, որոնք նպաստել են մահացու ելքին, բայց կապված չեն մահվան անմիջական պատճառ հանդիսացած հիվանդության հետ');
//            Վիրահատություններ
            $table->unsignedBigInteger('surgery_id')->comment('Վիրահատություններ')->nullable()->default(NULL);
            $table->timestamp('surgery_datetime')->nullable()->comment('Վիրահատություններ ամսաթիվը');
            $table->longText('surgery_comment')->nullable()->comment('Վիրահատություններ մանրամասներ');
//            RW հետազոտության ամսաթիվը
            $table->timestamp('RW_date')->nullable()->comment('Վիրահատություններ ամսաթիվը');
            $table->longText('result')->nullable()->comment('Արդյունքը');
//            Հայրենական պատերազմի հաշմանդամ
            $table->enum('armenia_war_invalid',['yes','no'])->nullable()->comment('Հայրենական պատերազմի հաշմանդամ');
//            Արցախյան պատերազմի հաշմանդամ
            $table->enum('arcax_war_invalid',['yes','no'])->nullable()->comment('Արցախյան պատերազմի հաշմանդամ<');
            $table->unsignedBigInteger('attending_doctor_id')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("surgery_id")->references("id")->on("surgery_lists");

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
        Schema::dropIfExists('stationary_discharge_cards');
    }
}
