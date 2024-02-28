<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalWasteRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_waste_registers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedSmallInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->text('waste_type')->comment('Բժշկական թափոնի տեսակ')->nullable();
            $table->date('admission_date')->comment('Բժշկական թափոնի տարողության բացման ամսաթիվ')->nullable();

            $table->text('emergency_registration')->comment('Վթարային իրավիճակների գրանցում')->nullable();

            $table->date('date_of_registration')->comment('Գրանցված վթարային իրավիճակի հաղորման ամսաթիվ')->nullable();
            $table->date('move_date')->comment('Տեղաթոխման ամսաթիվ')->nullable();

            $table->string('type_emergency_situation')->comment('Գրանցված վթարային իրավիճակի տեսակը/արտահոսք, ծակոցներ և այլն')->nullable();

            $table->unsignedBigInteger('responsible_for_waste_doctor_id')->comment('Բժշկական թափոնի պատասխանատու')->nullable();
            $table->foreign('responsible_for_waste_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('waste_handler_doctor_id')->comment('Բժշկական թափոնի հանձնող')->nullable();
            $table->foreign('waste_handler_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('receiver_waste_doctor_id')->comment('Բժշկական թափոնի ընդունող')->nullable();
            $table->foreign('receiver_waste_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('medical_waste_registers');
    }
}
