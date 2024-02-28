<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalLabN11STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_lab_n11_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('sender_doctor_id');
            $table->unsignedSmallInteger("stationary_id");

            $table->date('biopsy_date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->string('bbe_number')->nullable()->comment('Գլյուկոզ');
            $table->text('chamber')->nullable()->comment('Պալատ');
            
            $table->float('hemoglobin_man')->nullable()->comment('Հեմոգլոբին T');
            $table->float('hemoglobin_wooman')->nullable()->comment('Հեմոգլոբին K');
            $table->float('erythrocytes_man')->nullable()->comment('Էրիթրոցիտներ T');
            $table->float('erythrocytes_wooman')->nullable()->comment('Էրիթրոցիտներ K');
            $table->float('color_index')->nullable()->comment('Գունային ցուցանիշ');
            $table->float('blood_coagulation')->nullable()->comment('Արյան մակարդելիության ժամանակը ըստ Սուխարևի');

            $table->float('reticulocytes')->nullable()->comment('Ռետիկուլոցիտներ');
            $table->float('platelets')->nullable()->comment('Թրոմբոցիտներ');
            $table->float('leukocytes')->nullable()->comment('Լեյկոցիտներ');
            $table->float('blasts')->nullable()->comment('Բլաստներ');
            $table->float('promyelocytes')->nullable()->comment('Պրոմիելոցիտներ');
            $table->float('myelocytes')->nullable()->comment('Միելոցիտներ');

            $table->float('metamyelocytes')->nullable()->comment('Մետամիլեոցիտներ');
            $table->float('nozzles')->nullable()->comment('Ցուպիկակորիզավորներ');
            $table->float('segmented_stones')->nullable()->comment('Հատվածակորիզավորներ');
            $table->float('eosinophils')->nullable()->comment('Էոզինոֆիլներ');
            $table->float('basophils')->nullable()->comment('Բազոֆիլներ');
            $table->float('lymphocytes')->nullable()->comment('Լիմֆոցիտներ');

            $table->float('monocytes')->nullable()->comment('Մոնոցիտներ');
            $table->float('plasma_cells')->nullable()->comment('Պլազմոցիտներ');
            $table->float('erythrocyte_sedimentation_man')->nullable()->comment('Էրիթրոցիտների նստեցման արագություն /ռեակցիա/ ԷՆԱ T');
            $table->float('erythrocyte_sedimentation_wooman')->nullable()->comment('Էրիթրոցիտների նստեցման արագություն /ռեակցիա/ ԷՆԱ K');   

            $table->text('anisocytosis')->nullable()->comment('Անիզոցիտոզ');
            $table->text('poikilocytosis')->nullable()->comment('Պոյկիլոցիտոզ');
            $table->text('erythrocytes_with_basophilic')->nullable()->comment('Բազոֆիլային հատիկավորմամբ էրիթրոցիտներ');
            $table->text('polychromatophilia')->nullable()->comment('Պոլիքրոմատոֆիլիա');
            $table->text('jolies_bodies')->nullable()->comment('Ժոլիի մարմիններ');
            $table->text('erythro_normoblasts')->nullable()->comment('Էրիթրո-նորմոբլաստներ');

            $table->text('megaloblasts')->nullable()->comment('Մեգալոբլաստներ');
            $table->text('leukocyte_morphology')->nullable()->comment('Լեյկոցիտների ձևաբանություն');
            $table->text('core_overdose')->nullable()->comment('Կորիզների գերհատվածավորում');
            $table->text('toxic_granulation')->nullable()->comment('Թունածին հատիկավորում');

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
        Schema::dropIfExists('clinical_lab_n11_s');
    }
}
