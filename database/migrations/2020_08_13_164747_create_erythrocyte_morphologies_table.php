<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErythrocyteMorphologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erythrocyte_morphologies', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');

            $table->text('anocytosis_comment')->nullable()->comment('Անոզիցիտոզ - ազատ դաշտ');
            $table->text('poikilocytosis_comment')->nullable()->comment('պոյկիլոցիտոզ - ազատ դաշտ');
            $table->text('basophil_comment')->nullable()->comment('Բազոֆիլ - ազատ դաշտ');
            $table->text('polychromatophilia_comment')->nullable()->comment('պոլխրոմատոֆիլիա - ազատ դաշտ');
            $table->text('jolie_bodies_comment')->nullable()->comment('ժոլիի մարմիններ - ազատ դաշտ');
            $table->text('erythronormoblasts_comment')->nullable()->comment('էրիթրոնորմոբլաստներ - ազատ դաշտ');
            $table->text('mesaloblasts_comment')->nullable()->comment('մեզալոբլաստներ - ազատ դաշտ');
            $table->text('nuclear_over_segmentation_comment')->nullable()->comment('Կորիզների գերսեգմենտացում - ազատ դաշտ');
            $table->text('toxic_fatification_comment')->nullable()->comment('տոքսոգեն ֆատիկավորում - ազատ դաշտ');
      
            $table->date('analysis_response_date')->nullable()->comment('անալիզի պատասխան - ամսաթիվ');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('erythrocyte_morphologies');
    }
}
