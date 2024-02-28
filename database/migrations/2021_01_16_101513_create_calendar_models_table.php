<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("referral_id")->nullable();
            $table->unsignedBigInteger("patient_id")->nullable()->comment("Գլխավոր մասի հետ կապ");
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->string('soc')->nullable();
            $table->foreign('referral_id')->references('id')->on('referrals')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->dateTime('start')->nullable();
            $table->time('end')->nullable();
            $table->string('name')->nullable();
            $table->longText('comments')->nullable();

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
        Schema::dropIfExists('calendar_models');
    }
}
