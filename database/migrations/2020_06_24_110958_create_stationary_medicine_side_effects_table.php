<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryMedicineSideEffectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_medicine_side_effects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stationary_id');
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('medicine_id')->nullable();

            $table->string('type');
            $table->text('medicine_comment')->nullable();
            $table->timestamps();

            $table->foreign('stationary_id')->references('id')->on('stationaries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stationary_medicine_side_effects');
    }
}
