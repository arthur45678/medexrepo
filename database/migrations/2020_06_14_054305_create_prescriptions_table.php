<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('ambulator_id');
            $table->unsignedBigInteger('health_status_id');

            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');
            // $table->smallInteger('medicine_dose')->nullable()->comment('դեղի քանակ-3, (պահեստի հաշվարկի համար)');
            $table->float("medicine_dose", 6, 2, true)->nullable()->comment('դեղի քանակ-3, (պահեստի հաշվարկի համար)');
            $table->unsignedTinyInteger('measurement_unit_id')->nullable()->comment('id of measurement_units դեղի չափման միավոր');
            $table->text('prescription_text')->nullable()->comment('օրը քանի անգամ և այլն․․․');

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('health_status_id')->references('id')->on('health_statuses')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('prescriptions');
    }
}
