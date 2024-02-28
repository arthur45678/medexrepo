<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnesthesiologDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anesthesiolog_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->integer('anesthesiolog_id');
            $table->unsignedBigInteger('disease_id')->nullable();
            $table->unsignedBigInteger('treatment_id')->nullable()->default(NULL);
            $table->enum('type',['a','b','c','d','e'])->comment('a=>Ախտորոշումը, b=>Ուղեկցող հիվանդություններ, c=>Ներկայումս ստացող բուժում, d=>Կրած հիվանդություններ,e=>Վնասակար հիվանդությունները')->nullable();
            $table->text('surgeries_comment')->nullable()->default(NULL);
            $table->foreign('treatment_id')->references('id')->on('treatment_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('anesthesiolog_diagnoses');
    }
}
