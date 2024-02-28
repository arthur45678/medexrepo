<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_diagnoses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('card_id');
         //   $table->morphs("diagnosable");
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('user_id');

            // $table->enum(
            //     "diagnosis_type",
            //     ["admission", "referring institution"]
            // )->comment("Ախտորոշման տեսակը՝ ընդուվելիս կամ ուեգրող հաստատության");

            $table->string("diagnosable_type")->comment("Ախտորոշման տեսակը");

            $table->unsignedBigInteger('disease_id')->nullable()->default(NULL);

            $table->text('diagnosis_comment')->nullable()->default(NULL);
            $table->date('diagnosis_date')->nullable()->default(NULL);
            $table->string('drug_using_time')->comment('Օգտագործման ժամ')->nullable()->default(NULL);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('disease_id')->references('id')->on('disease_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('sample_diagnoses');
    }
}
