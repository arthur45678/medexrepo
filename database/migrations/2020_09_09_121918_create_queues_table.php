<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('number');
            $table->boolean('is_urgent')->default(false);

            $table->unsignedBigInteger('referral_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('referral_id')->references('id')->on('referrals');//->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('queues');
    }
}
