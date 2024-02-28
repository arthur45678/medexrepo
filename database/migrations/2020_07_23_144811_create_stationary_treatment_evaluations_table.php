<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryTreatmentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_treatment_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stationary_id');

            $table->string('eastern_cooperative_oncology_group')->nullable()->comment('ֆունկցիոնալ վիճակի գնահատում - option');
            $table->string('karnofsky_performance')->nullable()->comment('Կարնոֆսկու գործունակության սանդղակ - option');
            $table->string('treatment_effectiveness')->nullable()->comment('բուժման արդյունավետություն - option');

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
        Schema::dropIfExists('stationary_treatment_evaluations');
    }
}
