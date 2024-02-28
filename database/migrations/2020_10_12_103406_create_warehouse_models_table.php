<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('department_id')->nullable();
            $table->string('code')->comment('ծածկագիրը')->nullable();
            $table->integer('quantity')->comment('Մուտ եկած ապրանք-ի քանակը');
            $table->integer('price')->nullable()->comment('Միավորի արժեքը');
            $table->string('exit')->nullable()->comment('ելքի հաշիվ, ենթահաշիվ')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('warehouse_models');
    }
}
