<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrobiologyExaminationsForm2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microbiology_examinations_form_2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->text('medical_company_name')->comment('ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ')->nullable();
            $table->date('examination_date')->comment('կենսանյութը վերցնելու օր, ամիս, տարի')->nullable();

            $table->unsignedSmallInteger('department_id')->nullable()->default(NULL);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');

            $table->text('room')->comment('Պալատ')->nullable();

            $table->unsignedBigInteger('referred_doctor_id')->comment('Ուղեգրող բժիշկ')->nullable();
            $table->foreign('referred_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->text('card_number')->comment('Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի №')->nullable();
            $table->text('sterilisation')->comment('Ստերիլություն')->nullable();
            $table->text('tif_infection_info')->comment('Տիֆ պարատիֆային խմբի հարուցիչներ')->nullable();

            $table->unsignedBigInteger('attending_doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->date('test_response_date')->comment('Արյան բակտերիոլոգիական հետազոտության պատասխանի տրման օր, ամիս, տարի')->nullable();

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
        Schema::dropIfExists('microbiology_examinations_form_2');
    }
}
