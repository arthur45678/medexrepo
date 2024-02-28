<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stationary_id');
            $table->unsignedBigInteger('user_id');

            // $table->enum(
            //     "diagnosis_type",
            //     ["admission", "referring institution"]
            // )->comment("Ախտորոշման տեսակը՝ ընդուվելիս կամ ուեգրող հաստատության");

            $table->string("diagnosis_type")->comment("Ախտորոշման տեսակը");

            $table->unsignedBigInteger('disease_id')->nullable()->default(NULL);

            $table->text('diagnosis_comment')->nullable()->default(NULL);
            $table->date('diagnosis_date')->nullable()->default(NULL);

            $table->timestamps();

            $table->foreign('stationary_id')->references('id')->on('stationaries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stationary_diagnoses');
    }
}
