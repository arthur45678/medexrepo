<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXrayExaminationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xray_examination_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedBigInteger('examining_doctor_id');

            $table->date('reg_date')->comment('Ամսաթիվ');
           
            $table->text('research')->nullable()->comment('Հետազոտություն');
            $table->text('organ')->nullable()->comment('Օրգան');
            $table->text('type')->nullable()->comment('Տեսակ');
            $table->text('sum')->nullable()->comment('Գումար');
            $table->text('material')->nullable()->comment('Նյութ');
            $table->text('baso')->nullable()->comment('BaSO4');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('examining_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
           
            
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
        Schema::dropIfExists('xray_examination_logs');
    }
}
