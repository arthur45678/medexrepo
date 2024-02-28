<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingForResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_for_research', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');    
            $table->unsignedBigInteger('attending_doctor_id')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');

            $table->date('date')->nullable()->comment('ամսաթիվ');

            $table->string('action')->nullable()->comment('Գործողությունը');
            $table->string('stationary_pp')->nullable()->comment('Ստացիոնար պ/պ');
            $table->string('stationary_vj')->nullable()->comment('Ստացիոնար վճ');
            $table->string('social_package')->nullable()->comment('Սոց փաթեթ');
            $table->string('stationary_sp')->nullable()->comment('Ստացիոնար ս/պ');

            $table->string('ambulator_pp')->nullable()->comment('Ամբուլատոր պ/պ');
            $table->string('ambulator_internal')->nullable()->comment('Ամբուլատոր վճ ներքին');
            $table->string('ambulator_out')->nullable()->comment('Ամբուլատոր վճ դրսի');

            $table->string('social_package_internal')->nullable()->comment('Սոց փաթեթ ներքին');
            $table->string('social_package_out')->nullable()->comment('Սոց փաթեթ դրսի');

            $table->string('writing_sp_internal')->nullable()->comment('Ս/Պ ԳՐՈՒԹՅՈՒՅՈՒՆ ներքին');
            $table->string('writing_sp_out')->nullable()->comment('Ս/Պ ԳՐՈՒԹՅՈՒՅՈՒՆ դրսի');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('accounting_for_research');
    }
}
