<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistologicalExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histological_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('attending_doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->date('admission_date')->comment('Ամսաթիվ')->nullable();

            $table->unsignedSmallInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger("stationary_id")->comment('Ստացիոնար հիվանդի քարտ')->nullable();
            $table->foreign("stationary_id")->references("id")->on("stationaries");

            $table->unsignedBigInteger('ambulator_id')->comment('Ամբուլատոր հիվանդի քարտ')->nullable();
            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');

            $table->string('biopsy')->comment('Բիոպսիա')->nullable();
            $table->text('biopsy_dubble')->comment('Կրկնակի բիոպսիայի ժամանակ նշել նախորդի համարը №')->nullable();
            $table->date('biopsy_dubble_date')->comment('Կրկնակի բիոպսիայի ժամանակ նշել նախորդի ամսաթիվը')->nullable();

            $table->unsignedBigInteger('surgery_id')->comment('Վիրահատության անվանումը')->nullable()->default(NULL);
            $table->foreign('surgery_id')->references('id')->on('surgery_lists')->onDelete('restrict')->onUpdate('cascade');

            $table->date('surgery_date')->comment('Վիրահատության ամսաթիվը')->nullable();

            $table->text('substance_quantity')->comment('Նյութի քանակը')->nullable();
            $table->text('sample_quantity')->comment('Նմուշի քանակը')->nullable();

            $table->date('examination_date')->comment('Ամսաթիվ_ՀՅՈՒՍՎԱԾՔԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ')->nullable();
            $table->text('biopsy_diagnostic')->comment('Ախտորոշիչ բիոպսիա')->nullable();
            $table->text('biopsy_fast')->comment('Շտապ բիոպսիա')->nullable();
            $table->text('surgery_material')->comment('Վիրահատական նյութ')->nullable();
            $table->text('painting_method')->comment('Ներկման եղանակաը')->nullable();
            $table->text('macro_and_micro_description')->comment('Մակրո և միկրո նկարագրություն')->nullable();
            $table->date('diagnosis_date')->comment('Հետազոտման Ամսաթիվ')->nullable();


            $table->unsignedBigInteger('pathologist_doctor_id')->comment('Պաթոլոգ')->nullable();
            $table->foreign('pathologist_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('histological_examinations');
    }
}
