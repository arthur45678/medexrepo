<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsciousVoluntaryConsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conscious_voluntary_consents', function (Blueprint $table) {
            $table->id();
            $table->string('command_number')->comment('Հրաման №')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->date('admission_date')->nullable()->comment('Ամսաթիվ');

            $table->unsignedBigInteger('medicine_id')->comment('Բուժման համար նախատեսված դեղորայք')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');

            $table->string('payment_type')->comment("Արդյոք կա պետպատվեր, սոց․ ապահովագրություն, համավճար կամ վճարովի է")->nullable();
            $table->string('firstName_lastName_patronymic')->comment("Հիվանդի հարազատի, խնամակալի կամ օրինական ներկայացուցչի ԱԱՀ")->nullable();
            $table->text('treatment_description')->comment('Վիրահատություն, ռադիոթերապիա, քիմիոթերապիա և այլ')->nullable();

            $table->unsignedBigInteger('department_head_doctor_id')->comment('Բաժանմունքի վարիչ')->nullable();
            $table->foreign('department_head_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->date('client_confirm_date')->nullable()->comment('Ամսաթիվ, հիվանդի, կամ նրա բարեկամների համաձայնությունը տալու');
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
        Schema::dropIfExists('conscious_voluntary_consents');
    }
}
