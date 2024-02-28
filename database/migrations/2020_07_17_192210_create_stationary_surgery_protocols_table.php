<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationarySurgeryProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_surgery_protocols', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("anesthesiologist_id")->nullable()->default(NULL)->comment("Անեսթեզիստ");
            $table->unsignedBigInteger("anesthesiology_doctor_id")->nullable()->default(NULL)->comment("Անզգայացման բժիշկ");
            $table->unsignedBigInteger("stationary_id");

            $table->date("date")->nullable()->default(NULL);

            $table->unsignedBigInteger("surgery_id")->nullable()->default(NULL)->comment("Վիրահատության անվանում՝ ցանկից");
            $table->text("surgery_name")->nullable()->default(NULL)->comment("Վիրահատության անվանում");

            $table->timestamp("surgery_start")->nullable()->default(NULL)->comment("Վիրահատության սկիզբ");
            $table->timestamp("surgery_end")->nullable()->default(NULL)->comment("Վիրահատության ավարտ");

            $table->unsignedTinyInteger("anesthesia_id")->nullable()->default(NULL)->comment("Անզգայացման տեսակ");

            $table->unsignedBigInteger("medicine_id")->nullable()->default(NULL)->comment("Անզգայացման դեղամիջոց");
            $table->text("anesthesia_process")->nullable()->default(NULL)->comment("անզգայացման ընթացքը");

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("anesthesiologist_id")->references("id")->on("users");
            $table->foreign("anesthesiology_doctor_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");
            $table->foreign("surgery_id")->references("id")->on("surgery_lists");
            $table->foreign("medicine_id")->references("id")->on("medicine_lists");
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
        Schema::dropIfExists('stationary_surgery_protocols');
    }
}
