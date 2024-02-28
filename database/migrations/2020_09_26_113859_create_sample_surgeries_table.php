<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_surgeries', function (Blueprint $table) {
            $table->id();

            $table->morphs("surgeryable");

            $table->unsignedBigInteger('user_id');

            $table->string("surgeries_type")->comment("Ախտորոշման տեսակը");

            $table->unsignedBigInteger('surgery_id')->nullable()->default(NULL);

            $table->text('surgeries_comment')->nullable()->default(NULL);
            $table->date('surgeries_date')->nullable()->default(NULL);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('surgery_id')->references('id')->on('surgery_lists')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('sample_surgeries');
    }
}
