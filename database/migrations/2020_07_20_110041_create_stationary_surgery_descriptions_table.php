<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationarySurgeryDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_surgery_descriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->date("surgery_description_date")->nullable()->comment("վիրահատության նկարագրությունը - ամսաթիվ");
            $table->text("surgery_description_comment")->nullable()->comment("վիրահատության նկարագրությունը - ազատ տեքս");

            $table->unsignedBigInteger("surgeon_id")->nullable()->comment("վիրաբույժ");
            $table->unsignedBigInteger("assistant_id")->nullable()->comment("օգնական");
            $table->unsignedBigInteger("surgical_sister_id")->nullable()->comment("վիրաբուժական քույր");

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
        Schema::dropIfExists('stationary_surgery_descriptions');
    }
}
