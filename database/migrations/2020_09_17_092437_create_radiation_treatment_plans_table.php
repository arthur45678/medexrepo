<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiationTreatmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiation_treatment_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('radiation_card_id');
            $table->foreign('radiation_card_id')->references('id')->on('radiation_treatment_cards')->comment('ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ')->onDelete('restrict')->onUpdate('cascade');


            // 8 Կուրսը՝
            $table->boolean('course_radical_program')->nullable()->default(FALSE)->comment('Արմատական ծրագիր')->nullable();
            $table->boolean('course_amoqich')->nullable()->default(FALSE)->comment('Ամոքիչ')->nullable();
            $table->boolean('course_auxiliary')->nullable()->default(FALSE)->comment('Օժանդակ')->nullable();
            $table->boolean('course_effective')->nullable()->default(FALSE)->comment('Ներարդյունավետ')->nullable();

            //9 Դոզավորումը՝
            $table->boolean('dosage_standart')->nullable()->default(FALSE)->comment('Դոզավորումը՝ Ստանդարտ')->nullable();
            $table->boolean('dosage_mult')->nullable()->default(FALSE)->comment('Դոզավորումը՝ Մուլտ․')->nullable();
            $table->boolean('dosage_escal')->nullable()->default(FALSE)->comment('Դոզավորումը՝ Էսկալ')->nullable();
            $table->boolean('dosage_large')->nullable()->default(FALSE)->comment('Դոզավորումը՝ խոշոր')->nullable();
            $table->text('dosage_comment')->comment('Դոզավորումը Այլ')->nullable();

            //10․ Հիվանդի դիրքը
            $table->boolean('patient_position_on_the_back')->nullable()->default(FALSE)->comment('Հիվանդի դիրքը մեջքի վրա')->nullable();
            $table->boolean('patient_position_on_the_abdomen')->nullable()->default(FALSE)->comment('Հիվանդի դիրքը Փորի վրա')->nullable();
            $table->text('patient_position_comment')->comment('Հիվանդի դիրքը Դոզավորումը Այլ')->nullable();

            //11․ ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները, ԱՈՒՀ/ԱՄՀ, բլոկներ, սեպեր, ճոճումների արագությունը և քանակը, ժամանակը (յուր․ դաշտի համար), ԺԴԲ, ԿԱԴ, փնջի ելքը սանտիգրեյ/ր
            $table->text('ktc1')->comment('ԿԹԾ1')->nullable();
            $table->text('ktc2')->comment('ԿԹԾ2')->nullable();
            $table->text('ktc3')->comment('ԿԹԾ3')->nullable();

            // 12․ Բժիշկ ֆիզիկոս
            $table->unsignedBigInteger('physic_doctor_id')->comment('Բժիշկ ֆիզիկոս')->nullable();
            $table->foreign('physic_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            // Ճառ․ թերապևտ
            $table->unsignedBigInteger('radiation_therapevt_doctor_id')->comment('Ճառ․ թերապևտ')->nullable();
            $table->foreign('radiation_therapevt_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');



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
        Schema::dropIfExists('radiation_treatment_plans');
    }
}
