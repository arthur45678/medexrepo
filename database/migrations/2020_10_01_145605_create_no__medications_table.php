<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_sheet_id');
            $table->unsignedBigInteger('diagnostic_appointment_models');
            $table->date('appointment_date')->nullable();
            $table->date('end_day')->nullable();
            $table->foreign('appointment_sheet_id')->references('id')->on('appointment_sheet_models')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('diagnostic_appointment_models')->references('id')->on('diagnostic_appointment_models')->onDelete('restrict')->onUpdate('cascade');


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
        Schema::dropIfExists('no_medications');
    }
}
