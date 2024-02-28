<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryDiseaseOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_disease_outcomes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->string("outcome")->nullable()->comment("Հիվանդության ելք");
            $table->string("outcome_date")->nullable()->comment("Դուրս գրման, տեղափոխման կամ մահվան ամսաթիվ");

            $table->unsignedSmallInteger("transferred_clinic_id")->nullable()->comment("Տեղափոխված հաստատության անվանումը")->nullable()->default(NULL);
            $table->string("death_circumstance")->nullable()->default(NULL)->comment('Մահվան հանգամանքները');

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign("transferred_clinic_id")->references("id")->on("clinics");

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
        Schema::dropIfExists('stationary_disease_outcomes');
    }
}
