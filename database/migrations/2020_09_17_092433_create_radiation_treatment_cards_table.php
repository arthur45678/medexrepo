<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiationTreatmentCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiation_treatment_cards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            // 5.ա) Կլինիկական ախտորոշում
            $table->unsignedBigInteger('clinical_disease_id')->comment('հիվանդություն')->nullable();
            $table->foreign('clinical_disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->text('clinical_diagnosis_comment')->comment('Կլինիկական ախտորոշում')->nullable();

            // 5.բ) Պաթոմորֆ․ ախտորոշում և համար
            $table->unsignedBigInteger('patomorph_disease_id')->nullable();
            $table->foreign('patomorph_disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->text('patomorph_diagnosis_comment')->comment('Պաթոմորֆ․ ախտորոշում և համար')->nullable();

            //5. գ) Ուղեկցող հիվանդություններ
            $table->unsignedBigInteger('concomitant_disease_id')->nullable();
            $table->foreign('concomitant_disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->text('concomitant_diagnosis_comment')->comment('Ուղեկցող հիվանդություններ')->nullable();


            //6․ Նախկինում ստատցած բուժումը
            $table->text('previously_received_treatment')->comment('Նախկինում ստատցած բուժումը')->nullable();


            $table->date('surgery_date')->comment('Վիրահատություն Ամսաթիվ')->nullable();
            $table->unsignedBigInteger('surgery_disease_id')->nullable();
            $table->foreign('surgery_disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->text('surgery_diagnosis_comment')->comment('Վիրահատություն')->nullable();

            //chemterapy_disease_id
            $table->date('chemterapy_date')->comment('Քիմիաթերապիա Ամսաթիվ')->nullable();
            $table->text('chemterapy_comment')->comment('Քիմիաթերապիա')->nullable();

            $table->date('radiation_treatment_date')->comment('Ճառագայթային բուժում Ամսաթիվ')->nullable();
            $table->text('radiation_treatment_comment')->comment('Ճառագայթային բուժում')->nullable();
            $table->text('radiated_areas')->comment('Ճառագայթահարված հատվածները')->nullable();

            // 7
            $table->text('tumor_placement')->comment('ՈՒռուցքի տեղակայումը - (ՈՒԱԾ - տեղակայումը, ձևը, չափերը, խորությունը)')->nullable();


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
        Schema::dropIfExists('radiation_treatment_cards');
    }
}
