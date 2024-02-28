<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampOperationModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamp_operation_modes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('responsible_nurse')->nullable()->comment('Պատասխանատուլ բուժքույր');
            $table->timestamp('date')->comment('Ամսաթիվ');
            $table->longText('title')->nullable()->comment('Անվանում');
            $table->longText('regime')->nullable()->comment('Բակ․լամպի ռեժիմ');

            $table->timestamp('opening_start')->nullable()->comment('Բակ․լամպի բացման սկիզբ');
            $table->timestamp('opening_end')->nullable()->comment('Բակ․լամպի անջատում');
            $table->longText('regime_description')->nullable()->comment('Բակ․լամպի ռեժիմ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('responsible_nurse')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('lamp_operation_modes');
    }
}
