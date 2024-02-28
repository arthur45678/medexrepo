<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrobiologyExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microbiology_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');


            $table->text('medical_company_name')->comment('ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ')->nullable();
            $table->text('susceptibility_to_antibiotics')->comment('Զգայունության որոշում հակաբիոտիկների հանդեպ')->nullable();
            $table->date('susceptibility_to_antibiotics_date')->comment('Զգայունության որոշում հակաբիոտիկների հանդեպ')->nullable();


            $table->unsignedSmallInteger('department_id')->nullable()->default(NULL);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');

            $table->text('room')->comment('Պալատ')->nullable();

            $table->unsignedBigInteger('referred_doctor_id')->comment('Ուղեգրող բժիշկ')->nullable();
            $table->foreign('referred_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


            $table->text('agreement_number')->comment('Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի №')->nullable();
            $table->text('microbiology_examination')->comment('Մանրէաբանական հետազոտություն')->nullable();
            $table->text('isolated_microflora')->comment('Անջատված միկրոֆլորա')->nullable();

            //Զգայունության որոշում հակաբիոտիկների հանդեպ
            $table->text('antibiotk_amoxiclav')->comment('antibiotk_amoxiclav')->nullable();
            $table->boolean('amoxiclav_is_sensitive')->comment('amoxiclav - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_ciprofloxacin')->comment('antibiotk_ciprofloxacin')->nullable();
            $table->boolean('ciprofloxacin_is_sensitive')->comment('ciprofloxacin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_azithromycin')->comment('antibiotk')->nullable();
            $table->boolean('azithromycin_is_sensitive')->comment('azithromycin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Carbenicillin')->comment('Carbenicillin')->nullable();
            $table->boolean('Carbenicillin_is_sensitive')->comment('Carbenicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_ampicillin')->comment('ampicillin')->nullable();
            $table->boolean('ampicillin_is_sensitive')->comment('ampicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);


            $table->text('antibiotk_Cefazolin')->comment('Cefazolin')->nullable();
            $table->boolean('Cefazolin_is_sensitive')->comment('Cefazolin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Amoxicillin')->comment('Amoxicillin')->nullable();
            $table->boolean('Amoxicillin_is_sensitive')->comment('Amoxicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Cefotaxime')->comment('')->nullable();
            $table->boolean('Cefotaxime_is_sensitive')->comment('Cefotaxime - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Oxacillin')->comment('Oxacillin')->nullable();
            $table->boolean('Oxacillin_is_sensitive')->comment('Oxacillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Ceftazidime')->comment('Ceftazidime')->nullable();
            $table->boolean('Ceftazidime_is_sensitive')->comment('Ceftazidime - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Gentamicin')->comment('Gentamicin')->nullable();
            $table->boolean('Gentamicin_is_sensitive')->comment('Gentamicin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Cefuroxime')->comment('')->nullable();
            $table->boolean('Cefuroxime_is_sensitive')->comment('Cefuroxime - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Vancomycin')->comment('Vancomycin')->nullable();
            $table->boolean('Vancomycin_is_sensitive')->comment('Vancomycin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Ceftriaxone')->comment('Ceftriaxone')->nullable();
            $table->boolean('Ceftriaxone_is_sensitive')->comment('Ceftriaxone - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Imipenem')->comment('Imipenem')->nullable();
            $table->boolean('Imipenem_is_sensitive')->comment('Imipenem - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Moxifloxacin')->comment('Moxifloxacin')->nullable();
            $table->boolean('Moxifloxacin_is_sensitive')->comment('Moxifloxacin - զգայուն է - 1, զգայուն չէ - 0')->default(0);
            $table->text('antibiotk_Penicillin')->comment('Penicillin')->nullable();
            $table->boolean('Penicillin_is_sensitive')->comment('Penicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Norfloxacin')->comment('Norfloxacin')->nullable();
            $table->boolean('Norfloxacin_is_sensitive')->comment('Norfloxacin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Metronidazole')->comment('Metronidazole')->nullable();
            $table->boolean('Metronidazole_is_sensitive')->comment('Metronidazole - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Cefoperazone')->comment('Cefoperazone')->nullable();
            $table->boolean('Cefoperazone_is_sensitive')->comment('Cefoperazone - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_Doxicillin')->comment('Doxicillin')->nullable();
            $table->boolean('Doxicillin_is_sensitive')->comment('Doxicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);

            $table->text('antibiotk_furodonin')->comment('Doxicillin')->nullable();
            $table->boolean('furodonin_is_sensitive')->comment('Doxicillin - զգայուն է - 1, զգայուն չէ - 0')->default(0);


            $table->date('antibiotic_sensitive_date')->comment('Հակաբիոտիկների հանդեպ զգայունության որոշման պատասխանի տրման օր, ամիս, տարի')->nullable();


            //research_doctor_id
            $table->unsignedBigInteger('attending_doctor_id')->comment('Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('microbiology_examinations');
    }
}
