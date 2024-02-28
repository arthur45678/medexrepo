<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryInpatientRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_inpatient_registers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('research');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('stationary_id')->nullable()->comment('Հիվանդության պատմության թերթիկի');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Բուժման տեսակ");
            $table->enum('payment',['pp ','paid'])->nullable()->comment('Պետ Պատվեր,  վճարովի');
            $table->longText('payment_info')->nullable()->comment('վճարման մասին տեղեկություն');
            $table->timestamp('date')->nullable()->comment('Ընդունման ամսաթիվ');
            $table->timestamp('date_discharge')->nullable()->comment('Դուրս գրման ամսաթիվ');
            $table->string('number_days')->nullable()->comment('Օրերի քանակ՝');
            $table->integer('bed_id')->nullable()->comment('Մահճակալ');
            $table->longText('treatment_result')->nullable()->comment('Բուժման արդյունք');
            $table->unsignedBigInteger('doctor')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('stationary_id')->references('id')->on('stationaries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("treatment_id")->references("id")->on("treatment_lists");
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
        Schema::dropIfExists('stationary_inpatient_registers');
    }
}
