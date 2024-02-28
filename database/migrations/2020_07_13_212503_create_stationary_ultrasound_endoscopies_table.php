<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryUltrasoundEndoscopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_ultrasound_endoscopies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            // $table->string("attachment")->nullable()->default(NULL)->comment("Կցված ֆայլ");
            $table->text("examination_comment")->nullable()->default(NULL);
            $table->date("examination_date")->nullable()->default(NULL)->comment("Հետազոտության կատարման ամսաթիվ");

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
        Schema::dropIfExists('stationary_ultrasound_endoscopies');
    }
}
