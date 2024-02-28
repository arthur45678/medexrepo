<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN4STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n4_s', function (Blueprint $table) {
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
            
            $table->float('urine')->nullable()->comment('Միզանյութ');
            $table->float('uric_acid_man')->nullable()->comment('Միզաթթու T');
            $table->float('uric_acid_wooman')->nullable()->comment('Միզաթթու K');
            $table->float('creatine')->nullable()->comment('Կրեատինին');
            $table->float('coil_filtration')->nullable()->comment('Կծիկային ֆիլտրացիա');
            $table->float('reabsorption')->nullable()->comment('Ռեաբսորբցիա');
            
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
        Schema::dropIfExists('biochemical_lab_n4_s');
    }
}
