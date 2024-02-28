<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCareMedicineAndSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_care_medicine_and_sources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->unsignedBigInteger('medicine_id')->comment('Բուժման համար նախատեսված դեղորայք')->nullable();
            $table->enum('source_id',['a','b','c','d'])->nullable();
            $table->longText('medicine_comments')->nullable();
            $table->string('medicine_count')->nullable();
            $table->foreign('medicine_id', 'MCMAS_id_foreign')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('parent_id', 'P_id_foreign')->references('id')->on('medical_care_accounting1s')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('medical_care_medicine_and_sources');
    }
}
