<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningDiagnosisModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_diagnosis_models', function (Blueprint $table) {
            $table->id();
            $table->integer('planning_id')->nullable();
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
        Schema::dropIfExists('planning_diagnosis_models');
    }
}
