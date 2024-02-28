<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN5STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n5_s', function (Blueprint $table) {
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
            
            $table->float('calium')->nullable()->comment('Կալիում');
            $table->float('natrium')->nullable()->comment('Նատրիում');
            $table->float('calcium_total')->nullable()->comment('Կալցիում ընդհանուր');
            $table->float('calcium_ionized')->nullable()->comment('Կալցիում իոնիզացված');
            $table->float('inorganic_phosphorus')->nullable()->comment('Ֆոսֆոր անօրգանական');
            $table->float('chlorides')->nullable()->comment('Քլորիդներ');
            $table->float('chlorides_in_urine')->nullable()->comment('Քլորիդներ մեզի մեջ');
            $table->float('magnesium')->nullable()->comment('Մագնեզիում');
            $table->float('iron_man')->nullable()->comment('Երկաթ T');
            $table->float('iron_wooman')->nullable()->comment('Երկաթ K');

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
        Schema::dropIfExists('biochemical_lab_n5_s');
    }
}
