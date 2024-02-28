<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractDiagnosisAndSurgicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extract_diagnosis_and_surgicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->enum("type",['diagnosis','surgicals'])->nullable()->comment("radial=>Միայն ճառագայթային,complex=>Համալիր բուժում,other=>Բուժման այլ եղանակներ");;
            $table->string("data")->nullable();
            $table->longText("comments")->nullable();
            $table->foreign('parent_id', 'S_D_P_id_foreign')->references('id')->on('extracts')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('extract_diagnosis_and_surgicals');
    }
}
