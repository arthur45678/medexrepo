<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN7STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n7_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('sender_doctor_id');
            $table->unsignedSmallInteger("stationary_id")->nullable();
            
            $table->date('biopsy_date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->string('bbe_number')->nullable()->comment('Գլյուկոզ');
            $table->string('chamber')->nullable()->comment('Պալատ');
            
            $table->float('prothrombin_time')->nullable()->comment('Պրոթրոմբինային ժամանակ');
            $table->float('prothrombin_index')->nullable()->comment('Պրոթրոմբինային ինդեքս');
            $table->float('plasma_tolerance')->nullable()->comment('Պլազմայի տոլերանտությունը հեպարինի նկատմամբ');
            $table->float('fibrinogen')->nullable()->comment('Ֆիբրինոգեն ');
            $table->float('fibrinogen_b')->nullable()->comment('Ֆիբրինոգեն «Բ»');
            $table->float('normalized_international')->nullable()->comment('Միջազգային նորմալիզացված հարաբերություն ');
            $table->float('active_thromboplastin')->nullable()->comment('Ակտիվ մասնակի տրոմբոպլաստինային ժամանակ');
            $table->float('thrombin_time')->nullable()->comment('Թրոմբինային ժամանակ');
            $table->float('ddimer')->nullable()->comment('Դդիմեր');

            $table->date('research_date')->nullable()->comment('2- ամսաթիվ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sender_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            
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
        Schema::dropIfExists('biochemical_lab_n7_s');
    }
}
