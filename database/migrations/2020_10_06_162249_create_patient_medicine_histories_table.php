<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicineHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medicine_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('appointment_sheet_id');
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');

            $table->integer('drugs');
            $table->integer('const')->nullable();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('appointment_sheet_id')->references('id')->on('appointment_sheet_models')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('prescription_id')->references('id')->on('prescription_models')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('patient_medicine_histories');
    }
}
