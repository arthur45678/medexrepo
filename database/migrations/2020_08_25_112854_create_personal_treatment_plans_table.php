<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTreatmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_treatment_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->integer('regular')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedSmallInteger('department_id')->nullable();
            $table->timestamp('dateTime')->nullable()->comment('Ամսաթիվ , Ժամ');
//            2. Լաբարատոր գործիքային ախտորոշիչ հետազոտություններ
            $table->longText('results')->nullable()->comment(' Պացիենտի մոտ առկա իրականացվաց լաբարատոր գործիքային ախտորոշիչ հետազոտությունների արդյունքները');
//           2.2 Պլանավորվող լաբարատոր գործիքային ախտորոշիչ հետազոտությունները

            $table->longText('laboratory_research')->nullable()->comment(' Լաբարատոր հետազոտություններ');

            $table->longText('Instrumental_research')->nullable()->comment('Գործիքային հետազոտություններ');
            $table->longText('radiation_research')->nullable()->comment('Ճառագայթային ախտորոշիչ հետազոտություններ');
            $table->longText('histological_research')->nullable()->comment('Հյուսվածցքաբանական կամ բջջաբանական հետազոտություններ');
            $table->longText('other_research')->nullable()->comment('Այլ նշումներ');
//            3. Բժշկական օգնության և սպասարկման պլանավորվող

            $table->longText('Surgical_intervention')->nullable()->comment('Վիրահատական միջամտություն');
            $table->longText('chemotherapy_treatment')->nullable()->comment('Քիմիաթերապևտիկ բուժում');
            $table->longText('radiation_therapy')->nullable()->comment('Ճառագայթային թերապիա');
            $table->longText('other_interventions')->nullable()->comment('Այլ միջամտություններ');
//            4. Միջփուլային հսկողություն
            $table->longText('intermediate_control')->nullable()->comment('Միջփուլային հսկողություն');
//            4.1 Վիրահատական միջամտությունից հետո

            $table->longText('after_surgery')->nullable()->comment('Վիրահատական միջամտությունից հետո');
            $table->longText('aap_surgery')->nullable()->comment('ԱԱՊ բժշկին ներկայանալ');
//            3) Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ
            $table->longText('to_introduce')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');
//            Քիմիաթերապևտիկ բուժումից հետո

            $table->longText('after_chemotherapy_treatment')->nullable()->comment('Քիմիաթերապևտիկ բուժումից հետո');
            $table->longText('sap_chemotherapy')->nullable()->comment('ԱԱՊ բժշկին ներկայանալ');
            $table->longText('to_come_closer')->nullable()->comment(' Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');

//            4.3 Ճառագայթային թերապիայից հետո
            $table->longText('after_radiation_therapy')->nullable()->comment('Ճառագայթային թերապիայից հետո');
            $table->longText('aap_radiation')->nullable()->comment('ԱԱՊ բժշկին ներկայանալ');
            $table->longText('doctor_oncologist_radiation')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ');
//            4.4 Հատուկ նշումներ
            $table->longText('special_note')->nullable()->comment('Հատուկ նշումներ');

//            5. Բուժումը ավարտելուց հետո հետագա հսկողությունը
            $table->longText('further_control')->nullable()->comment('   Բուժումը ավարտելուց հետո հետագա հսկողությունը');
            $table->longText('aap_control')->nullable()->comment('ԱԱՊ բժշկին ներկայանալ');
            $table->longText('diagnostic_tests')->nullable()->comment('Լաբարատոր գործիքային ախտորոշիչ հետազոտություններ');
            $table->longText('special_notes')->nullable()->comment('Հատուկ նշումներ');
            $table->timestamp('date_treatment')->nullable()->comment('Անհատական բուժման պլանի կազմելու ամսաթիվը');

            $table->unsignedBigInteger('doctor_oncologist')->nullable()->comment('Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբան');
            $table->unsignedBigInteger('oncologist_surgeon')->nullable()->comment('Վիրաբույժ-ուռուցքաբան');
            $table->unsignedBigInteger('chemotherapist')->nullable()->comment('Քիմիաթերապևտ');
            $table->unsignedBigInteger('histologist')->nullable()->comment('Հյուսվածցքաբան');
            $table->unsignedBigInteger('radiologist')->nullable()->comment('Ճառագայթաբան');
            $table->unsignedBigInteger('specialist')->nullable()->comment('Ճառագայթային ախտորոշման մասնագետ');
            // foreign keys
            //            5. Բուժումը ավարտելուց հետո հետագա հսկողությունը

            $table->foreign('doctor_oncologist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('oncologist_surgeon')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('chemotherapist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('histologist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('radiologist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('specialist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            //           end

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments');

            /*$table->unsignedBigInteger('supplement_doctor_id')->comment('Լրացնող բժիշկ')->nullable();
            $table->foreign('supplement_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');*/

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
        Schema::dropIfExists('personal_treatment_plans');
    }
}
