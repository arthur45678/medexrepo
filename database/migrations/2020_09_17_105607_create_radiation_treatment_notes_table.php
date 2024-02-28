<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiationTreatmentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table - 15․Ճառագայթահարման օրագիր
        Schema::create('radiation_treatment_notes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('radiation_card_id');
            $table->foreign('radiation_card_id')->references('id')->on('radiation_treatment_cards')->comment('ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ')->onDelete('restrict')->onUpdate('cascade');

            //15․Ճառագայթահարման օրագիր
            $table->date('radiation_date')->comment('Ճառագայթահարման Ամսաթիվը և ժամը')->nullable();            $table->text('patient_position_comment')->comment('Հիվանդի դիրքը Դոզավորումը Այլ')->nullable();
            $table->text('irradiated_area')->comment('Ճառագայթահարվող հատվածը')->nullable();
            $table->text('field_dimensions')->comment('Դաշտի չափերը')->nullable();
            $table->text('radiation_intensity')->comment('Ճառագայթահարման տևողությունը')->nullable();
            $table->text('mod')->comment('ՄՕԴ')->nullable();
            $table->text('god')->comment('ԳՕԴ')->nullable();
            $table->text('N_dd')->comment('N_ԴԴ')->nullable();

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
        Schema::dropIfExists('radiation_treatment_notes');
    }
}
