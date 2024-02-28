<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTransfusionRecordBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_transfusion_record_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();

            $table->text('bag_number')->nullable()->comment('պարկի համար rh խումբ');

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
        Schema::dropIfExists('blood_transfusion_record_books');
    }
}
