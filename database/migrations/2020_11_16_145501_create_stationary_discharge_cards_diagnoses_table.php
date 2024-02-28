<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryDischargeCardsDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_discharge_cards_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('disease_id')->nullable();

            $table->enum('type',['aa','ab','ac','ba','bb','bc'])->nullable()->comment('Ստացիանար է ընդունվել անհետաձգելի ցուցումով');
            $table->longText('diagnoses_comments')->nullable();
            $table->foreign('parent_id')->references('id')->on('stationary_discharge_cards')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('stationary_discharge_cards_diagnoses');
    }
}
