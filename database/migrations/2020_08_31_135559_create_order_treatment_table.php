<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_treatment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Բուժման տեսակ");
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
        Schema::dropIfExists('order_treatment');
    }
}
