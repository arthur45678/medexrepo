<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmunologicalExaminationPatternN5STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunological_examination_pattern_n5_s', function (Blueprint $table) {
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
//          ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ

            $table->longText('rhesus_factor')->nullable()->comment('Ռեզուս գործոն');
            $table->longText('blood_group')->nullable()->comment('Արյան խումբ');
            $table->longText('RPR')->nullable()->comment('RPR (պրեցիպիտացիայի ռեակցիա)');
            $table->timestamp('date_research')->nullable()->comment('Շճաբանական հետազոտության պատասխանի ամսաթիվ');

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
        Schema::dropIfExists('immunological_examination_pattern_n5_s');
    }
}
