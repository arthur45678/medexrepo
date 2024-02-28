<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN8STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n8_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('sender_doctor_id');
            $table->unsignedSmallInteger("stationary_id")->nullable();
            
            $table->date('biopsy_date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->string('bbe_number')->nullable()->comment('Գլյուկոզ');
            $table->string('chamber')->nullable()->comment('Պալատ');
            
            $table->float('common_protein')->nullable()->comment('Ընդհանուր սպիտակուց');
            $table->float('total_bilirubin')->nullable()->comment('Ընդհանուր բիլիռուբին');
            $table->float('related_bilirubin')->nullable()->comment('կապված բիլիռուբին');
            $table->float('free_bilirubin')->nullable()->comment('ազատ բիլիռուբին');
            $table->float('timol_experience')->nullable()->comment('Թիմոլային փորձ');
            $table->float('urine')->nullable()->comment('Միզանյութ');
            $table->float('glucose')->nullable()->comment('Գլյուկոզ');
            $table->float('aspartate_aminotransferase')->nullable()->comment('Ասպարտատամինոտրասֆերազա (ԱՍՏ)');
            $table->float('alanine_aminotransferase')->nullable()->comment('Ալանինամինոտրանսֆերազա(ԱԼՏ)');

            $table->date('research_date')->nullable()->comment('2- ամսաթիվ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sender_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            
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
        Schema::dropIfExists('biochemical_lab_n8_s');
    }
}
