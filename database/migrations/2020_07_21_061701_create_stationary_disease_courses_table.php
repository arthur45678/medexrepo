<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryDiseaseCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_disease_courses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->date("disease_course_date")->nullable()->comment("հիվանդության ընթացքը - ամսաթիվ");
            $table->text("disease_course_comment")->nullable()->comment("հիվանդության ընթացքը - ազատ դաշտ");

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");

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
        Schema::dropIfExists('stationary_disease_courses');
    }
}
