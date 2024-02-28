<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_treatments', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('card_id');
            $table->morphs("treatable");
            $table->unsignedBigInteger('user_id');

            $table->string("treatments_type")->comment("Ախտորոշման տեսակը");

            $table->unsignedBigInteger('treatment_id')->nullable()->default(NULL);

            $table->text('treatment_comment')->nullable()->default(NULL);
            $table->date('treatment_date')->nullable()->default(NULL);


            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('treatment_id')->references('id')->on('treatment_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('sample_treatments');
    }
}
