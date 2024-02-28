<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryEpicrisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_epicrises', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stationary_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedBigInteger('department_head_id');
            $table->unsignedBigInteger('chief_doctor_id');

            $table->date('epicrisis_date')->nullable()->default(NULL);
            $table->text('epicrisis')->nullable()->default(NULL)->comment('Էպիկրիզ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('stationary_id')->references('id')->on('stationaries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_head_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('chief_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('stationary_epicrises');
    }
}
