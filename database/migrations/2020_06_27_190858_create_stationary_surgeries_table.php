<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationarySurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_surgeries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->unsignedBigInteger("surgery_id")->nullable()->comment("Վիրահատության անվանում");
            $table->unsignedTinyInteger("anesthesia_id")->nullable()->comment("Անզգայացման եղանակ");

            $table->string("type");
            $table->text("complications")->nullable()->default(NULL)->comment("Հետվիրահատական բարդություններ");
            $table->timestamp("surgery_date")->nullable();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign("surgery_id")->references("id")->on("surgery_lists");
            $table->foreign("anesthesia_id")->references("id")->on("anesthesia_lists");

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
        Schema::dropIfExists('stationary_surgeries');
    }
}
