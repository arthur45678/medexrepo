<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSterilizationModeSistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sterilization_mode_sisters', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');     
            $table->unsignedBigInteger('attending_doctor_id')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');

            $table->date('main_date')->nullable()->comment('ամսաթիվ');

            $table->text('name')->nullable()->comment('Անվանում');
            $table->string('count')->nullable()->comment('Քանակ');
            $table->boolean('cleaning_method')->nullable()->comment('աքրման եղանակ');
            $table->text('cleaning_method_name')->nullable()->comment('Մաքրող նյութի անվանում');
            $table->text('disinfection_method')->nullable()->comment('Ախտահանման եղանակ');
            $table->text('axt_name')->nullable()->comment('Անվանում');
            $table->text('according')->nullable()->comment('Ըստ կից հրահանգի');
            $table->text('start')->nullable()->comment('Սկիզբ');
            $table->text('end')->nullable()->comment('Վերջ');
            $table->text('nax_name')->nullable()->comment('Անվանում');
            $table->text('nax_count')->nullable()->comment('Քանակ');
            $table->string('processing_number')->nullable()->comment('Անվանում');
            $table->text('presence_blood')->nullable()->comment('Արյան հետքերի առկայություն');
            $table->text('traces_detergent')->nullable()->comment('Լվացող հեղուկի հետքերի առկայություն');
            $table->text('medical_name')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ անվանում');
            $table->text('medical_count')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ Քանակ');
            $table->time('sterilizer_tool_time')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ անվանում');
            $table->text('steril_tool_time')->nullable()->comment('ՄԱՆՐԷԱԶԵՐԾՄԱՆ ՌԵԺԻՄ Մանրէազերծիչ գործիքի միացման ժամ');
            $table->text('steril_tool_temperature')->nullable()->comment('Ջերմաստիճան');
            $table->time('steril_tool_endtime')->nullable()->comment('Վերջ ժամ');
            $table->time('steril_tool_removetime')->nullable()->comment('Հանելու ժամ');
            $table->text('control_sterilizers')->nullable()->comment('Մանրէազերծիչ սարքերի աշխատանքի հսկողություն');
            $table->text('medical_tools_name')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ անվանում');
            $table->text('medical_tools_count')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ Քանակ');
            $table->text('medical_itemsname_disinfectant')->nullable()->comment('ԲԺՇԿԱԿԱՆ ԻՐԵՐԻ Մանրէազերծող նյութի անվանում/խտություն ըստ հրահանգի պահանջի');
            $table->date('steril_prep_date')->nullable()->comment('Մանրէազերծող նյութի պատրաստման ամսաթիվ');
            $table->text('test_result')->nullable()->comment('Թեսթի արդյունքը');
            $table->text('steril_material_time')->nullable()->comment('Մանրէազերծող սարքի միացման ժամանակ քիմիական նյութի մեջ ընկղման ժամ');
            $table->time('steril_mode_start')->nullable()->comment('Սկիզբ ժամ');
            $table->time('steril_mode_end')->nullable()->comment('Վերջ ժամ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('sterilization_mode_sisters');
    }
}
