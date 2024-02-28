<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientConcomitantDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // պացիենտի ուղղեկցեղ հիվանդութհունները
        Schema::create('patient_concomitantDiseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('disease_id')->comment('Ուղղեկցեղ հիվանդության ID')->nullable()->default(NULL);
            $table->foreign('disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');

            $table->text('description')->comment('Ուղղեկցեղ հիվանդության բնութագիր');

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
        Schema::dropIfExists('patient_concomitantDiseases');
    }
}
