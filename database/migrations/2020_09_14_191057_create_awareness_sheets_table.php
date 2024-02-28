<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwarenessSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awareness_sheets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedBigInteger('department_head_id');
            $table->unsignedBigInteger('director_id');

            $table->date('first_date')->nullable()->comment('1 - ամսաթիվ');
            $table->date('second_date')->nullable()->comment('2- ամսաթիվ');

            $table->string( 'service_recipient' )->comment('սպասարկում ստացող անձ');
            $table->boolean('accept')->nullable()->comment('համաձայն եմ , համաձայն չեմ');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_head_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('director_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('awareness_sheets');
    }
}
