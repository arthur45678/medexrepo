<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualTreatmentPlansAppointmentsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_treatment_plans_appointments_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")->nullable()->comment("Գլխավոր մասի հետ կապ");
            $table->unsignedBigInteger('medicine_id')->comment('Բուժման համար նախատեսված դեղորայք')->nullable();
            $table->text('appointments_comments')->nullable()->comment('Թէ դեղը որքան օգտագործի․');
            $table->enum('type',['surgical','chemotherapy','radiation','control'])->nullable()->comment('Թէ դեղը որքան օգտագործի․');

            $table->foreign("parent_id")->references("id")->on("individual_treatment_plans");
            $table->foreign('medicine_id', 'itpalm_id_foreign')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('individual_treatment_plans_appointments_lists');
    }
}
