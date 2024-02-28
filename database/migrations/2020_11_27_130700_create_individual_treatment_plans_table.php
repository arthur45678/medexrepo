<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualTreatmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_treatment_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('department_id');
            $table->longText('manipulation')->nullable();

            $table->unsignedBigInteger("surgery_id")->nullable()->default(NULL)->comment("Վիրահատության անվանում՝ ցանկից");
            $table->longText("surgery_comment")->nullable();


            $table->timestamp('entry_date')->comment('Դիմելու ամսաթիվ');
            $table->longText('get_from')->nullable()->comment('Պացիենտի մոտ առկա իրականացվախծ լաբարատոր գործիքային ախտորոշիչ հետազոտությունների արդյունքները');
            $table->longText('histological_other_comment')->nullable()->comment('Այլ նշումներ');
            $table->longText('other_interventions')->nullable()->comment('Այլ միջամտություններ');
            $table->longText('intermediate_control')->nullable();
//            Վիրահատական միջամտությունից հետո
            $table->longText('surgical_after_surgical_comment')->nullable()->comment(' Վիրահատական միջամտությունից հետո');
            $table->unsignedBigInteger('doctor_surgical_id')->nullable()->comment('Ա.Ա.Պ բժշկի մոտ ներկայանալ');
            $table->longText('doctor_surgical_comment')->nullable()->comment('Ա.Ա.Պ բժշկի նկարագրությունը');
            $table->longText('surgical_present_comment')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');
//            Քիմիաթերապևտիկ բուժումից հետո
            $table->longText('after_chemotherapy_comment')->nullable()->comment('Քիմիաթերապևտիկ բուժումից հետո');
            $table->unsignedBigInteger('doctor_chemotherapy_id')->nullable()->comment('Ա.Ա.Պ բժշկի մոտ ներկայանալ');
            $table->longText('doctor_chemotherapy_comment')->nullable();
            $table->longText('chemotherapy_present_comment')->nullable();
//           Ճառագայթային թերապիայից հետո
            $table->unsignedBigInteger('doctor_radiation_id')->nullable()->comment('Ա.Ա.Պ բժշկի մոտ ներկայանալ');
            $table->longText('doctor_radiation_comment')->nullable();
            $table->longText('radiation_present_comment')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');
            $table->longText('radiation_other_comment')->nullable()->comment('Հատուկ նշումներ');
//            Բուժումն ավարտելուց հետո հետագա հսկողությունը
            $table->longText('after_control_comment')->nullable()->comment('Քիմիաթերապևտիկ բուժումից հետո');
            $table->unsignedBigInteger('doctor_control_id')->nullable()->comment('Ա.Ա.Պ բժշկի մոտ ներկայանալ');
            $table->longText('doctor_control_comment')->nullable();
            $table->longText('control_present_comment')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');
            $table->longText('control_other_comments')->nullable()->comment('Հատուկ նշումներ');
//            Անհատական բուժման պլանի կազմելու ամսաթիվ
            $table->date('treatment_date')->nullable()->comment('Անհատական բուժման պլանի կազմելու ամսաթիվ');

            $table->unsignedBigInteger('doctor_oncologist_id')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբան');
            $table->unsignedBigInteger('surgeon_oncologist_id')->nullable()->comment('Վիրաբույժ-ուռուցքաբան');
            $table->unsignedBigInteger('chemotherapist_id')->nullable()->comment('Քիմիաթերապևտ');
            $table->unsignedBigInteger('histologist_id')->nullable()->comment('Հյուսվածքաբան');
            $table->unsignedBigInteger('radiologist_id')->nullable()->comment('Ճառագայթաբան');
            $table->unsignedBigInteger('radiologist_specialist_id')->nullable()->comment('Ճառագայթային ախտորոշման մասնագետ');


            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("surgery_id")->references("id")->on("surgery_lists");
            $table->foreign('doctor_surgical_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_chemotherapy_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_radiation_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_control_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('doctor_oncologist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('surgeon_oncologist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('chemotherapist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('histologist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('radiologist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('radiologist_specialist_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('individual_treatment_plans');
    }
}
