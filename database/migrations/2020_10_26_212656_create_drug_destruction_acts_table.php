<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugDestructionActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_destruction_acts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('head_doctor_id')->comment('Գլխավոր բժիշկ')->nullable();
            $table->foreign('head_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('pharmacy_manager_id')->comment('Դեղատան վարիչ')->nullable();
            $table->foreign('pharmacy_manager_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('chief_nurse_id')->comment('Գլխավոր բուժքույր')->nullable();
            $table->foreign('chief_nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->date('started_destroying_date')->comment('նյութերի սրվակների ոչնչացում Ամսաթիվ Սկսած')->nullable();
            $table->date('finished_destroying_date')->comment('նյութերի սրվակների ոչնչացում Ամսաթիվ Մինչև')->nullable();

            $table->text('dose')->comment('Քանակը՝/տառերով և թվերով/')->nullable();
            $table->text('dose_patients')->comment('Թմրամիջոցներ և հոգեմետ դեղեր ստացած հիվանդների քանակը, նշել հիվանդության պատմագրերի համարները՝')->nullable();

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
        Schema::dropIfExists('drug_destruction_acts');
    }
}
