<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryPathologicalAnatomicalDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_pathological_anatomicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stationary_id');

            $table->date('autopsy_date')->nullable()->comment('դիահերձման ամսաթիվ');
            $table->string('autopsy_protocol')->nullable()->comment('դիահերձման արձանագրություն - համար');
            $table->text('cause_of_death')->nullable()->comment('մահվան պատճառը - ազատ դաշտ');
            $table->text('pathological_anatomical_epicrisis')->nullable()->comment('ախտաբանա-անատոմիական էպիկրիզ - ազատ դաշտ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('stationary_id')->references('id')->on('stationaries')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('stationary_pathological_anatomical_diagnoses');
    }
}
