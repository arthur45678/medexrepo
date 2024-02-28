<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnsetAndDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onset_and_developments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambulator_id');
            $table->unsignedBigInteger('user_id');

            $table->text('oad_comment')->comment('հիվանդության սկիզբը և դրա զարգացումը բլոկի - տեքտս');
            $table->date('oad_date')->comment('տվյալ տեքստի ամսաթիվ');
            $table->timestamps();

            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onset_and_developments');
    }
}
