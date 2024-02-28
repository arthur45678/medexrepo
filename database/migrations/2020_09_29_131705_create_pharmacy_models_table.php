<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_models', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('department_id')->nullable();
            $table->string('department_code')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');
            $table->string('medicine_code')->comment('դեղի համարը');
            $table->enum('act',['act','medication'])->default('medication')->comment('Դեսղ է թե ակտ');
            $table->unsignedTinyInteger('unit_of_measurement')->nullable()->comment('id of measurement_units դեղի չափման միավոր');
            $table->string('comment')->nullable()->comment('Դեղի նկարագրությունը');
            $table->string('price')->comment('Դեղի գումարը');
            $table->integer('balance_of_the_month')->default(0)->comment('Մնացորդ ամսվա սկզբում');
            $table->integer('enter')->comment('Մուտ եկած դեղերի քանակը');
            $table->integer('cost')->comment('Որքան դեղահաբ է ծախսվել քանակը')->default(0);
            $table->integer('balance_end_math_count')->default(0)->comment('Մնացորդը ամսվա վերջում');
            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('unit_of_measurement')->references('id')->on('measurement_units')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('pharmacy_models');
    }
}
