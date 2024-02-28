<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceSheetInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_sheet_insurances', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->date('admission_date')->comment('Ամսաթիվ')->nullable();

            $table->text('complaints')->comment('Գանգատներ')->nullable();
            $table->text('research_done')->comment('Կատարված հետազոտություն')->nullable();
            $table->text('Indications_for_surgery')->comment('Վիրահատության ցուցումներ')->nullable();
            $table->text('volume_of_surgery')->comment('Վիրահատության ծավալ')->nullable();


            $table->unsignedBigInteger('department_head_id')->comment('Տնօրեն')->nullable();
            $table->foreign('department_head_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


            $table->unsignedBigInteger("attending_doctor_id")->nullable()->default(NULL)->comment("Բուժող բժիշկ");
            $table->foreign("attending_doctor_id")->references("id")->on("users");

           /* $table->unsignedSmallInteger("department_id")->nullable()->default(NULL)->comment("Բաժանմունք");
            $table->foreign("department_id")->references("id")->on("departments");*/


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
        Schema::dropIfExists('advice_sheet_insurances');
    }
}
