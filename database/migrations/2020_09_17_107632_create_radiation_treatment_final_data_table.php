<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiationTreatmentFinalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Եզրափակիչ տվյալներ
        Schema::create('radiation_treatment_final_data', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('radiation_card_id');
            $table->foreign('radiation_card_id')->references('id')->on('radiation_treatment_cards')->comment('ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ')->onDelete('restrict')->onUpdate('cascade');

            // 16. Ճառագ․․ ռեակցիա՝
            $table->boolean('radio_reaction_no')->nullable()->default(FALSE)->comment('Ճառագ․․ ռեակցիա չկա՝  ')->nullable();
            $table->boolean('radio_reaction_location')->nullable()->default(FALSE)->comment('Ճառագ․․ ռեակցիա՝  տեղ')->nullable();
            $table->boolean('radio_reaction_hematologist')->nullable()->default(FALSE)->comment('Ճառագ․․ ռեակցիա՝ արյունաբան')->nullable();
            $table->boolean('radio_reaction_general')->nullable()->default(FALSE)->comment('Ճառագ․․ ռեակցիա՝ ընդհանուր')->nullable();
            $table->tinyInteger('radio_reaction_category')->nullable()->default(FALSE)->comment('Ճառագ․․ ռեակցիա՝ Աստիճանը')->nullable();
            $table->text('radio_reaction_comment')->comment('Կլինիկական ախտորոշում')->nullable();

            //17․ Բուժման արդյունքը
            $table->boolean('radio_reaction_full_absorption')->nullable()->default(FALSE)->comment('լրիվ ներծծում- Բուժման արդյունքը ')->nullable();
            $table->boolean('radio_reaction_small_50_procent')->nullable()->default(FALSE)->comment('<50% Բուժման արդյունքը ')->nullable();
            $table->boolean('radio_reaction_high_50_procent')->nullable()->default(FALSE)->comment('>50% Բուժման արդյունքը ')->nullable();
            $table->boolean('radio_reaction_without_result')->nullable()->default(FALSE)->comment('Բուժման արդյունքը առանց արդյունքի')->nullable();
            $table->boolean('radio_reaction_deepening')->nullable()->default(FALSE)->comment('Բուժման արդյունքը խորացում')->nullable();

            //18. Եզրափակիչ տվյալներ
            $table->text('ktc_1')->comment('Եզրափակիչ տվյալներ ԿԹԾ1')->nullable();
            $table->text('ktc_2')->comment('Եզրափակիչ տվյալներ ԿԹԾ2')->nullable();
            $table->text('ktc_3')->comment('Եզրափակիչ տվյալներ ԿԹԾ3')->nullable();
            $table->text('mod_1')->comment('Եզրափակիչ տվյալներ ՄՕԴ1')->nullable();
            $table->text('mod_2')->comment('Եզրափակիչ տվյալներ ՄՕԴ2')->nullable();
            $table->text('mod_3')->comment('Եզրափակիչ տվյալներ ՄՕԴ3')->nullable();

            $table->text('god_1')->comment('Եզրափակիչ տվյալներ ԳՕԴ1')->nullable();
            $table->text('god_2')->comment('Եզրափակիչ տվյալներ ԳՕԴ2')->nullable();
            $table->text('god_3')->comment('Եզրափակիչ տվյալներ ԳՕԴ3')->nullable();

            $table->text('jdb_1')->comment('Եզրափակիչ տվյալներ ԺԴԲ1')->nullable();
            $table->text('jdb_2')->comment('Եզրափակիչ տվյալներ ԺԴԲ2')->nullable();
            $table->text('jdb_3')->comment('Եզրափակիչ տվյալներ ԺԴԲ3')->nullable();

            //Special notes
            $table->text('special_notes')->comment('Special notes')->nullable();

            $table->unsignedBigInteger('attending_doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('department_head_doctor_id')->comment('Բաժնի վարիչ')->nullable();
            $table->foreign('department_head_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


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
        Schema::dropIfExists('radiation_treatment_final_data');
    }
}
