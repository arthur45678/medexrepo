<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN2STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n2_s', function (Blueprint $table) {
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
            $table->text('total_cholesterol')->nullable()->comment('Ընդհանուր խոլեստերին');
            $table->float('beta_lipoproteins')->nullable()->comment('բետա–լիպոպրոտեիդներ');
            $table->float('low_density_lipoproteins')->nullable()->comment('Ցածր խտությամբ լիպոպրոտեիդներ');
            $table->float('very_low_density_lipoproteins')->nullable()->comment('Շատ ցածր խտությամբ լիպոպրոտեիդներ');
            $table->float('high_density_lipoproteins')->nullable()->comment('Բարձր խտությամբ լիպոպրոտեիդներ');
            $table->float('triglycerides')->nullable()->comment('Տրիգլիցերիդներ');
            $table->float('atherogenic_coefficient_man')->nullable()->comment('Աթերոգենության գործակից Txamard');
            $table->float('atherogenic_coefficient_wooman')->nullable()->comment('Աթերոգենության գործակից Kin');

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
        Schema::dropIfExists('biochemical_lab_n2_s');
    }
}
