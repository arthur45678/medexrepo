<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualTreatmentPlansTreatmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_treatment_plans_treatment_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")->nullable()->comment("Գլխավոր մասի հետ կապ");
            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Բուժման տեսակ");
            $table->text("treatment_comment")->nullable()->comment("Բուժման լրացուցիչ մեկնաբանություն");
            $table->enum("type",['chemotherapy','radiation']);
            $table->foreign("parent_id")->references("id")->on("individual_treatment_plans");
            $table->foreign("treatment_id")->references("id")->on("treatment_lists");
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
        Schema::dropIfExists('individual_treatment_plans_treatment_lists');
    }
}
