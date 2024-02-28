<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryHarmfulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_harmfuls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->unsignedTinyInteger("harmful_id")->nullable()->default(NULL)->comment("Վիրահատության անվանում");
            $table->text("harmful_comment")->nullable()->default(NULL)->comment("Անզգայացման եղանակ");

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign("harmful_id")->references("id")->on("harmfuls");

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
        Schema::dropIfExists('stationary_harmfuls');
    }
}
