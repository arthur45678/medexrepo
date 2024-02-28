<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_management', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('attending_doctor_id')->comment('Հերթապահ Բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('nurse_doctor_id')->comment('Հերթապահ Բժիշկ')->nullable();
            $table->foreign('nurse_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->date('admission_date')->comment('Ամսաթիվ')->nullable();
            $table->integer('mode_v')->comment('Ռեժիմը V (շնչառական ծավալը)')->nullable();
            $table->text('mode_v_comment')->comment('Ռեժիմը V (շնչառական ծավալը տեքստ)')->nullable();
            $table->integer('patient_v_cxp')->comment('Հիվանդի V cxp')->nullable();
            $table->text('patient_v_cxp_comment')->comment('Հիվանդի V cxp  տեքստ')->nullable();
            $table->integer('fq')->comment('Fq (շնչ.Հաճախ)')->nullable();
            $table->text('fq_comment')->comment('Fq (շնչ.Հաճախ  տեքստ)')->nullable();
            $table->integer('patient_fq')->comment('Հիվանդի Fq')->nullable();
            $table->text('patient_fq_comment')->comment('Հիվանդի Fq տեքստ')->nullable();
            $table->integer('fiO2_peep')->comment('FiO2 / PEEP')->nullable();
            $table->text('fiO2_peep_comment')->comment('FiO2 / PEEP տեքստ')->nullable();
            $table->integer('ps_respiratory_assistance')->comment('Ps (շնչ.Օգնություն)')->nullable();
            $table->text('ps_respiratory_assistance_comment')->comment('Ps (շնչ.Օգնություն) տեքստ')->nullable();
            $table->integer('in_the_airways_saO2')->comment('Ճնշ. Շնչուղիներում SaO2')->nullable();
            $table->text('in_the_airways_saO2_comment')->comment('Ճնշ. Շնչուղիներում SaO2 տեքստ')->nullable();
            $table->integer('artery_pressure')->comment('Զարկ. Ճնշում')->nullable();
            $table->text('artery_pressure_comment')->comment('Զարկ. Ճնշում տեքստ')->nullable();
            $table->integer('central_vein_pressure')->comment('Կենտ երակ ճնշ.')->nullable();
            $table->text('central_vein_pressure_comment')->comment('Կենտ երակ ճնշ տեքստ.')->nullable();
            $table->integer('pulse')->comment('Պուլս')->nullable();
            $table->text('pulse_comment')->comment('Պուլս տեքստ')->nullable();
            $table->integer('temperature')->comment('Ջերմություն')->nullable();
            $table->text('temperature_comment')->comment('Ջերմություն տեքստ')->nullable();
            $table->integer('dihurez')->comment('Դիհուրեզ տեքստ')->nullable();
            $table->text('dihurez_comment')->comment('Դիհուրեզ')->nullable();
            $table->integer('drainages')->comment('Դրենաժներ')->nullable();
            $table->text('drainages_comment')->comment('Դրենաժներ տեքստ')->nullable();
            $table->integer('imported_liquid_ml')->comment('Ներմուծված հեղուկ Մլ.')->nullable();
            $table->text('imported_liquid_ml_comment')->comment('Ներմուծված հեղուկ Մլ տեքստ.')->nullable();

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
        Schema::dropIfExists('patients_management');
    }
}
