<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->comment('ուղարկող-կապողի id, նույն user-ն է');
            $table->unsignedBigInteger('patient_id')->comment('հիվանդի id');
            $table->unsignedBigInteger('receiver_id')->nullable()->comment('ստացողի id, որին կցվել կամ որը ընդունել է հիվանդին');
            $table->unsignedSmallInteger('department_id')->nullable()->comment('բաժնի id, որին կցվել է հիվանդը');

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('receiver_id')->references('id')->on('users');
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
        Schema::dropIfExists('patient_connections');
    }
}
