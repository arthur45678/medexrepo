<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvicesheetinsuranceDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advicesheetinsurance_doctors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('advicesheetinshurans_id')->nullable();
            $table->foreign('advicesheetinshurans_id')->references('id')->on('advice_sheet_insurances')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('attending_doctor_id')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->text('doctors_comment')->nullable();

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
        Schema::dropIfExists('advicesheetinsurance_doctors');
    }
}
