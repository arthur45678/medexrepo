<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_queues', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('number');
            $table->date('enqueue_date');
            $table->text('comment')->nullable();
            $table->boolean('expired')->default(false);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedSmallInteger('department_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('api_patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments');//->onDelete('resctrict')->onUpdate('cascade');

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
        Schema::dropIfExists('api_queues');
    }
}
