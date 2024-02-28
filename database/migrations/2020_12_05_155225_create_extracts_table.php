<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('research')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger("stationary_id")->nullable();
            $table->unsignedBigInteger('ambulator_id')->nullable()->comment('Ամբուլատոր բժշկական քարտի №');
            $table->unsignedBigInteger('attending_doctor')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');

            $table->longText('extract_sent')->nullable()->comment('Հաստատության անվնաումն ու հասցեն,ուր քաղվածքն ուղարկվում է');
            $table->enum('for_the_first_time',['yes','no'])->nullable()->comment('Չարորակ նորագոյացության ախտորոշումը դրվել է կյանքում առաջին անգամ');
            $table->date('date')->nullable()->comment('Հատուկ բուժում սկսելու ամսաթիվ');
            $table->longText('tumor_histological_structure')->nullable()->comment('Ուռուցքի հյուսվածքաբանական կառուցվածքը');
            $table->enum('treatment_type',['radical','palliative'])->nullable()->comment('Բուժումը');
            $table->longText('remote_gammotherapy')->nullable()->comment('Դիստանցիոն գամմաթերապիա');
            $table->longText('rentgenoterapia')->nullable()->comment('Ռենտգենոթերապիա');
            $table->longText('fast_electrons')->nullable()->comment('Արագ էլեկտրոններ');
            $table->longText('gammotherapy')->nullable()->comment('Համակցված կոնտակտային և դիստանցիոն գամմաթերապիա');
            $table->longText('contact_rentgenoterapia')->nullable()->comment(' Կոնտակտային գամմաթերապիա և խորը ռենտգենոթերապիա');
            $table->longText('only_chemotherapeutic_or_hormonal')->nullable()->comment('Միայն քիմիաթերապևտիկ կամ հորմոնային');
            $table->date('admission_date')->nullable()->comment('Ամսաթիվ');


            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('extracts');
    }
}
