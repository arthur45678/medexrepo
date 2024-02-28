<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiochemicalLabN9STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_lab_n9_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('sender_doctor_id');
            $table->unsignedSmallInteger("stationary_id")->nullable();
            
            $table->date('biopsy_date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->string('bbe_number')->nullable()->comment('Գլյուկոզ');
            $table->string('chamber')->nullable()->comment('Պալատ');
            
            $table->float('total_protein')->nullable()->comment('Ընդհանուր սպիտակուց /TP/');
            $table->float('albumin')->nullable()->comment('Ալբումին');
            $table->float('urine')->nullable()->comment('Միզանյութ');
            $table->float('creatine_man')->nullable()->comment('Կրեատինին T');
            $table->float('creatine_wooman')->nullable()->comment('Կրեատինին K');
            $table->float('cystatin')->nullable()->comment('Ցիստատին Ց');
            $table->float('uric_acid')->nullable()->comment('Միզաթթու');
            $table->float('total_cholesterol')->nullable()->comment('Ընդհանուր խոլեստերին');
            $table->float('low_density_lipoproteins')->nullable()->comment('Ցածր խտությամբ լիպոպրոտեիդներ');
            $table->float('high_density_lipoproteins')->nullable()->comment('Բարձր խտությամբ լիպոպրոտեիդներ');
            $table->float('triglycerides')->nullable()->comment('Տրիգլիցերիդներ');
            $table->float('total_bilirubin')->nullable()->comment('Ընդհանուր բիլիռուբին');
            $table->float('related_bilirubin')->nullable()->comment('կապված բիլիռուբին');
            $table->float('free_bilirubin')->nullable()->comment('ազատ բիլիռուբին');
            $table->float('glucose')->nullable()->comment('Գլյուկոզ/GLU/մազանոթ./երակային');
            $table->float('troponin')->nullable()->comment('Տրոպոնին Տ');
            $table->float('glycosylated_hemoglobin')->nullable()->comment('Գլիկոլիզացված հեմոգլոբին');
            $table->float('insulin')->nullable()->comment('Ինսուլին');
            $table->float('pre_insulin')->nullable()->comment('Նախաինսուլին');
            $table->float('peptide')->nullable()->comment('պեպտիդ');
            $table->float('alpha_amylase')->nullable()->comment('Ալֆա ամիլազ ');
            $table->float('uroamylase')->nullable()->comment('Ուրոամիլազ');
            $table->float('lipase')->nullable()->comment('Լիպազ');
            $table->float('basic_phosphatase')->nullable()->comment('Հիմնային ֆոսֆատազ');
            $table->float('acid_phosphatase')->nullable()->comment('Թթվային ֆոսֆատազ');
            $table->float('gammaglutamyltransferase')->nullable()->comment('Գամագլուտամիլտրանսֆերազ');
            $table->float('aspartateaminotransferase')->nullable()->comment('Ասպարտատամինոտրանսֆերազ');
            $table->float('alanineaminotransferase')->nullable()->comment('Ալանինատամինոտրանսֆերազ');
            $table->float('lactatedehydrogenase')->nullable()->comment('Լակտատդեհիդրոգենազ');
            $table->float('cholinesterase')->nullable()->comment('Խոլինէսթերազ');
            $table->float('creatine_kinase_general_man')->nullable()->comment('Կրեատինկինազա-ընդհանուր');
            $table->float('creatine_kinase_general_wooman')->nullable()->comment('Կրեատինկինազա-ընդհանուր');
            $table->float('creatine_kinase')->nullable()->comment('Կրեատինկինազա');
            
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
        Schema::dropIfExists('biochemical_lab_n9_s');
    }
}
