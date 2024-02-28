<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUltrasoundEndoscopicExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ultrasound_endoscopic_examinations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id'); 
            $table->unsignedBigInteger('attending_doctor_id');

            $table->text('research_type')->nullable()->comment('Հոտազոտության տեսակ - ազատ դաշտ');
            $table->text('description_comment')->nullable()->comment('Նկարագիր - ազատ դաշտ');
            $table->text('conclusion_comment')->nullable()->comment('Եզարակացություն - ազատ դաշտ');
            $table->text('recommended_comment')->nullable()->comment('Խորհուրդ է տրվում - ազատ դաշտ');
            $table->timestamp('date')->nullable()->comment('Ամսաթիվ');



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
        Schema::dropIfExists('ultrasound_endoscopic_examinations');
    }
}
