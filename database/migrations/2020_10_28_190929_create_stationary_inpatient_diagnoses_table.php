<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryInpatientDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_inpatient_diagnoses', function (Blueprint $table) {
            $table->id();

            $table->integer('inpatient_id')->nullable();
            $table->enum('type',['enter ','exit'])->nullable();
            $table->unsignedBigInteger('disease_id')->nullable();
            $table->text('diagnosis_comment')->nullable();
            $table->foreign('disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('stationary_inpatient_diagnoses');
    }
}
