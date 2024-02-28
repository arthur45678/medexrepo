<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientFirstInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_first_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('first_clinic', 170)->nullable()->comment('առաջին անգամ դիմեց - որտեղ');
            $table->date('first_clinic_date')->nullable()->comment('առաջին անգամ դիմեց - երբ');
            $table->string('first_discovered', 170)->nullable()->comment('առաջին անգամ հայտնաբերվեց - որտեղ');
            $table->date('first_discovered_date')->nullable()->comment('առաջին անգամ հայտնաբերվեց - երբ');
            $table->text('past_treatments', 1000)->nullable()->comment('անցյալում ստացած բուժումները');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            // $table->foreign('first_discovered')->references('id')->on('clinics')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_first_infos');
    }
}
