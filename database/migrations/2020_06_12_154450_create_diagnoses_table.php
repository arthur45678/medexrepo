<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambulator_id');
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('disease_id')->nullable();
            $table->text('diagnosis_comment')->nullable();
            $table->date('diagnosis_date')->nullable();
            $table->enum('type', ['preliminary', 'final', 'previous'])->comment('Նախնական(preliminary) և վերջնական(final), նախկինուն(previous)');

            $table->timestamps();

            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('diagnoses');
    }
}
