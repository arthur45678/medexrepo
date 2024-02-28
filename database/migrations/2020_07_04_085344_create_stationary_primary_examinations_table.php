<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryPrimaryExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_primary_examinations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("stationary_id");
            $table->foreign("stationary_id")->references("id")->on("stationaries")->onUpdate("cascade")->onDelete("restrict");

            $table->date("examination_date")->nullable()->default(NULL);
            $table->text("complaints")->nullable()->default(NULL)->comment("Գանգատներ");
            $table->text("anamnesis_morbi")->nullable()->default(NULL);
            $table->text("growth_and_development")->nullable()->default(NULL)->comment("Աճ և զարգացում");
            $table->text("inheritance")->nullable()->default(NULL)->comment("Ժառանգականությունը ծանրաբեռնված է");
            $table->text("sextual_history")->nullable()->default(NULL)->comment("սեռական անամնեզ");

            $table->unsignedTinyInteger("menarche_age")->nullable()->default(NULL)->comment("menarche տարիք");
            $table->date("last_mensis")->nullable()->default(NULL)->comment("Վերջին mensis");
            $table->unsignedTinyInteger("menopausa_age")->nullable()->default(NULL)->comment("menopausa տարիք");

            $table->unsignedTinyInteger("number_of_pregnancies")->nullable()->default(NULL)->comment("Հղիությունների քանակը");
            $table->unsignedTinyInteger("number_of_abortions")->nullable()->default(NULL)->comment("վիժումների քանակը");
            $table->unsignedTinyInteger("number_of_interruptions")->nullable()->default(NULL)->comment("արհեստական ընդհատումների քանակը");
            $table->unsignedTinyInteger("number_of_births")->nullable()->default(NULL)->comment("ծննդաբերությունների քանակը");

            $table->unsignedTinyInteger("cycle_from")->nullable()->default(NULL)->comment("ցիկլ");
            $table->unsignedTinyInteger("cycle_to")->nullable()->default(NULL)->comment("ցիկլ");

            $table->boolean("breast_feeding")->nullable()->default(NULL)->comment("կրծքով կերակրելը");
            $table->string("breast_feeding_comment")->nullable()->default(NULL);

            $table->boolean("taking_hormonal_drugs")->nullable()->default(NULL)->comment("հորմոնային դեղամիջոցների ընդունում");
            $table->string("taking_hormonal_drugs_comment")->nullable()->default(NULL);

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
        Schema::dropIfExists('stationary_primary_examinations');
    }
}
