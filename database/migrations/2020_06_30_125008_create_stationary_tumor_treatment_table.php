<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryTumorTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_tumor_treatment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("stationary_id");
            $table->unsignedTinyInteger("tumor_treatment_list_id");

            $table->foreign("tumor_treatment_list_id")->references("id")->on("tumor_treatment_lists");
            $table->foreign("stationary_id")->references("id")->on("stationaries");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stationary_tumor_treatments');
    }
}
