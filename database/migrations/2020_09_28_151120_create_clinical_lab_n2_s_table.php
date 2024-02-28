<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalLabN2STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_lab_n2_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('sender_doctor_id');
            $table->unsignedSmallInteger("stationary_id");
            
            $table->date('biopsy_date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->string('bbe_number')->nullable()->comment('Հ/Հ');
            $table->text('chamber')->nullable()->comment('Պալատ');
            
            $table->text('hemoglobin')->nullable()->comment('Հեմոգլոբին');
            $table->text('erythrocyte_sedimentation_rate')->nullable()->comment('Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)');
            $table->text('leukocytes')->nullable()->comment('Լեյկոցիտներ');
            
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
        Schema::dropIfExists('clinical_lab_n2_s');
    }
}
