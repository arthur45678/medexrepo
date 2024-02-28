<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeryParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgery_participants', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('attending_doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Ծառայություն");
            $table->foreign("treatment_id")->references("id")->on("treatment_lists");


            $table->unsignedSmallInteger('department_id')->nullable()->default(NULL);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');

            $table->text('coverage')->comment('Ծածկույթ')->nullable();


            $table->unsignedBigInteger('reanimatolog_doctor_id')->comment('Ռեանիմատոլոգ')->nullable();
            $table->foreign('reanimatolog_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('anastesiology_nurse_id')->comment('Անեսթեզ բ/ք՝')->nullable();
            $table->foreign('anastesiology_nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


            $table->unsignedBigInteger('surgery_nurse_id')->comment('Վիրահատարանի բ/ք')->nullable();
            $table->foreign('surgery_nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('medical_orderly_id')->comment('Վիրահատարան մայրապետ')->nullable();
            $table->foreign('medical_orderly_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('assistant_doctor_id')->comment('Ասիստենտ')->nullable();
            $table->foreign('assistant_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('anesthesiologist_doctor_id')->comment('Անեսթեզիոլոգ')->nullable();
            $table->foreign('anesthesiologist_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


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
        Schema::dropIfExists('surgery_participants');
    }
}
