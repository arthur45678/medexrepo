<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCareMedicineLabServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_care_medicine_lab_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->unsignedBigInteger('lab_service_id')->comment('Կատարված լաբորատոր և գործիքային հետազոտություններ')->nullable();
            $table->longText('lab_comments')->nullable();
            $table->string('lab_count')->nullable();
            $table->foreign('lab_service_id')->references('id')->on('lab_service_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('medical_care_accounting1s')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('medical_care_medicine_lab_services');
    }
}
