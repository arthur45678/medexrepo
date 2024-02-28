<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressPaterrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_paterrns', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->comment('Կրկին ավելացնելու համար')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedSmallInteger('department_id');
            $table->longText('hospital_room_number')->comment('Հիվանդասենյակի համարը');
            $table->integer('attending_doctor_id')->comment('Ուղեգրող բժշկի անուն, ազգանուն');
            $table->integer('historian')->nullable()->comment('Հիվանդության պատմագրի №');
            $table->timestamp('dateTime')->comment('Ամսաթիվ , Ժամ');
//7  5          Արյան կլինիկական հետազոտություն
            $table->longText('hemoglobin')->comment('Հեմոգլոբին')->nullable();
            $table->longText('erythrocytes')->comment('Էրիթրոցիտներ')->nullable();
            $table->longText('leukocytes')->comment('Լեյկոցիտներ')->nullable();
            $table->longText('hematocrit')->comment('Հեմատոկրիտ')->nullable();
            $table->longText('ena')->comment('Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)')->nullable();
//            Արյան կենսաքիմիական հետազոտություն
            $table->longText('glucose')->comment('Գլյուկոզ')->nullable();
            $table->longText('urine')->comment('Միզանյութ')->nullable();
            $table->longText('prothrombin')->comment('Պրոթրոմբին')->nullable();
            $table->longText('bilirubin')->comment('Բիլիռուբին')->nullable();
            $table->longText('just')->comment('ՈՒղղակի')->nullable();
            $table->longText('indirect')->comment('Անուղղակի')->nullable();
            $table->longText('coagulation')->comment('Մակարդելիության ժամանակ')->nullable();
            $table->longText('common_protein')->comment('Ընդհանուր սպիտակուց')->nullable();
            $table->longText('diastasis')->comment('Դիաստազ')->nullable();
            $table->longText('amylase')->comment('Ամիլազ')->nullable();
//           Մեզի հետազոտություն
            $table->longText('color')->comment('Գույն')->nullable();
            $table->longText('specific_weight')->comment('Տեսակարար կշիռ')->nullable();
            $table->longText('protein')->comment('Սպիտակուց')->nullable();
            $table->longText('ketone_bodies')->comment('Կետոնային մարմիններ')->nullable();
            $table->longText('sediment')->comment('Նստվածք')->nullable();
            $table->longText('urine_erythrocytes')->comment('էրիթրոցիտներ')->nullable();
            $table->longText('urine_leukocytes')->comment('Լեյկոցիտներ')->nullable();
            $table->longText('urine_epithelium')->comment('էպիթել')->nullable();
            $table->longText('urine_rollers')->comment('Գլանակներ')->nullable();
            $table->longText('urine_crystals')->comment('Բյուրեղներ')->nullable();
            $table->longText('urine_microorganisms')->comment('Միկրոօրգանիզմներ')->nullable();
            $table->longText('urine_doctor')->comment('Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն')->nullable();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments');

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
        Schema::dropIfExists('express_paterrns');
    }
}
