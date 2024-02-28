<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractTreatmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extract_treatment_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Ծառայություն");

            $table->longText("treatment_comments")->nullable()->comment("Ծառայություն Նկարագրություն");
            $table->enum("type",['radial','complex','other'])->nullable()->comment("radial=>Միայն ճառագայթային,complex=>Համալիր բուժում,other=>Բուժման այլ եղանակներ");;

            $table->foreign('parent_id', 'E_P_id_foreign')->references('id')->on('extracts')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('extract_treatment_lists');
    }
}
