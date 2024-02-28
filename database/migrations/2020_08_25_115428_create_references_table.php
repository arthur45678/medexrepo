<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedBigInteger('department_head_id');
            $table->unsignedBigInteger('chief_doctor_id');

            $table->date('date')->nullable()->comment('ամսաթիվ');

            $table->text('reference_diagnosis')->nullable()->comment('ախտորոշում');
            $table->text('treatment')->nullable()->comment('ստացած բուժումը');
            $table->text('doctor_advice')->nullable()->comment('բժշկի խորհուրդը');

            $table->date('from_date')->nullable()->comment('անալիզի պատասխան - ամսաթիվ');
            $table->date('to_date')->nullable()->comment('անալիզի պատասխան - ամսաթիվ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('references');
    }
}
