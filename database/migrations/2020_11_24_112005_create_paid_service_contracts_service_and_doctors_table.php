<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidServiceContractsServiceAndDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_service_contracts_service_and_doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedMediumInteger('service_id')->nullable();
            $table->unsignedBigInteger('doctor')->nullable()->comment('doctor');
            $table->enum('type',['service','doctor'])->comment('Service or doctor ')->nullable();
            $table->text('service_comment')->nullable()->default(NULL);

            $table->foreign('parent_id')->references('id')->on('paid_service_contracts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('paid_service_contracts_service_and_doctors');
    }
}
