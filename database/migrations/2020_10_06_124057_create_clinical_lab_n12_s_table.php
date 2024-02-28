<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalLabN12STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_lab_n12_s', function (Blueprint $table) {
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
            
            $table->float('count_l')->nullable()->comment('Քանակը l');
            $table->float('count_ml')->nullable()->comment('Քանակը ml');
            $table->text('color')->nullable()->comment('Գույնը');
            $table->text('transparency')->nullable()->comment('Թափանցիկությունը');
            $table->float('relative_density')->nullable()->comment('Հարաբերական խտությունը');
            $table->text('reaction')->nullable()->comment('Ռեակցիա');
            $table->float('protein_gl')->nullable()->comment('Սպիտակուց _գ/լ');
            $table->float('protein_g')->nullable()->comment('Սպիտակուց գ%_');
            $table->float('glucose_mmol')->nullable()->comment('Գլյուկոզ մմոլ/լ');
            $table->float('glucose_g')->nullable()->comment('Գլյուկոզ գ%');
            $table->float('ketone_bodies')->nullable()->comment('Կետոնային մարմիններ');
            $table->string('hemoglobin')->nullable()->comment('Հեմոգլոբին');

            $table->text('bilirubin')->nullable()->comment('Բիլիռուբին');
            $table->text('urobilinoids')->nullable()->comment('Ուռոբիլինոիդներ');
            $table->text('bile_acids')->nullable()->comment('Լեղաթթուներ');
            $table->text('indica')->nullable()->comment('Ինդիկան');

            $table->text('flat')->nullable()->comment('Ինդիկան');
            $table->text('transitional')->nullable()->comment('Անցումային');
            $table->text('renal')->nullable()->comment('Երիկամային');
            $table->text('leukocytes')->nullable()->comment('Լեյկոցիտներ');
            $table->text('erythrocytes')->nullable()->comment('Էրիթրոցիտներ');

            $table->boolean('erythrocytes_bool')->nullable()->comment('Էրիթրոցիտներ  Անփոփոխ/Փոփոխված');

            $table->text('hyalina')->nullable()->comment('Հիալինային');
            $table->text('granular')->nullable()->comment('Հատիկավոր');
            $table->text('wax')->nullable()->comment('Մոմանման');
            $table->text('epithelial')->nullable()->comment('Էպիթելային');
            $table->text('leukocyte')->nullable()->comment('Լեյկոցիտար');
            $table->text('erythrocytar')->nullable()->comment('էրիթրոցիտար');
            $table->text('pigmented')->nullable()->comment('Պիգմենտային');
            $table->text('mucus')->nullable()->comment('Լորձ');
            $table->text('salts')->nullable()->comment('Աղեր');
            $table->text('bacteria')->nullable()->comment('Բակտերիաներ');

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
        Schema::dropIfExists('clinical_lab_n12_s');
    }
}
