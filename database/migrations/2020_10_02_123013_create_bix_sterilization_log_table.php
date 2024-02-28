<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBixSterilizationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bixSterilizationLog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->date('bix_sterilisation_date')->nullable()->comment('Ամսաթիվ');
            $table->date('bix_send_date')->nullable()->comment('Բիքսի ուղակման ժամանակ');
            $table->string('bix_type')->nullable()->comment('Բիքսի հավաքման տեսակ');
            $table->timestamp('bix_surgery_date')->nullable()->comment('Բիքսի բերման ժամանակ');
            $table->text('surgery_table_preparation')->nullable()->comment('Վիրահատական սեղանի պատրաստման ժամանակ');
            $table->text('remarks')->comment('Դիտողություններ');

            $table->unsignedBigInteger('nurse_id')->comment('Վիրահատական սեղանի բուժքույր');
            $table->foreign("nurse_id")->references("id")->on("users");

            $table->unsignedBigInteger('general_nurse_id')->comment('Գլխավոր բուժքույր');
            $table->foreign("general_nurse_id")->references("id")->on("users");

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('bixSterilizationLog');
    }
}
