<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('appointment_sheet_id');

            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');
            $table->tinyInteger('medicine_dose')->nullable()->comment('դեղի քանակ-3, (պահեստի հաշվարկի համար)');
            $table->unsignedTinyInteger('measurement_unit_id')->nullable()->comment('id of measurement_units դեղի չափման միավոր');
            $table->text('prescription_comments')->nullable()->comment('Թէ դեղը որքան օգտագործի․');
            $table->integer('drugs')->nullable();
            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('appointment_sheet_id')->references('id')->on('appointment_sheet_models')->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('prescription_models');
    }
}
