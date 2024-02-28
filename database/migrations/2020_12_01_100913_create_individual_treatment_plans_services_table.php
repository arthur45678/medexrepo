<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualTreatmentPlansServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_treatment_plans_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")->nullable()->comment("Գլխավոր մասի հետ կապ");
            $table->unsignedMediumInteger('service_id')->nullable();
            $table->enum('type',['laboratory','instrumental','radiation','histological']);
            $table->longText('comment')->nullable();
            $table->foreign("parent_id")->references("id")->on("individual_treatment_plans");
            $table->foreign('service_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('individual_treatment_plans_services');
    }
}
