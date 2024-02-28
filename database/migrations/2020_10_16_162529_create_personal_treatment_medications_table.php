<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTreatmentMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_treatment_medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id')->nullable()->comment('ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ համարը');
            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');
            $table->enum('type',['surgery','chemotherapy','radiation','diagnostic'])->nullable();
            $table->longText('comment')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('treatment_id')->references('id')->on('personal_treatment_plans')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('personal_treatment_medications');
    }
}
