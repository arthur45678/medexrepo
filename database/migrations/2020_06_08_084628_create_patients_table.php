<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('p_name')->nullable()->default(NULL);

            $table->text('residence_region')->nullable()->default(NULL)->comment('Գրանցման Հասցե - մարզ, շրջան');
            $table->text('town_village')->nullable()->default(NULL)->comment('Գրանցման Հասցե - գյուղ, քաղաք');
            $table->text('street_house')->nullable()->default(NULL)->comment('Գրանցման Հասցե - փողոց, տուն');

            # START դաշտեր հսկիչ քարտի համար ստեղծված
            $table->text('residence_region_residence')->nullable()->default(NULL)->comment('Բնակության Հասցե - մարզ, շրջան');
            $table->text('town_village_residence')->nullable()->default(NULL)->comment('Բնակության Հասցե - գյուղ, քաղաք');
            $table->text('street_house_residence')->nullable()->default(NULL)->comment('Բնակության Հասցե - փողոց, տուն');

            $table->unsignedTinyInteger('living_place_id')->nullable()->default(NULL)->comment('Բնակության վայր - Քաղաքաբնակ, Գյուղաբնակ');
            $table->text('citizenship')->nullable()->default(NULL)->comment('Քաղաքացիություն');

            $table->unsignedTinyInteger('social_living_condition_id')->nullable()->comment('Սոցիալ կենցաղային պայմաններ - id');
            $table->unsignedTinyInteger('working_feature_id')->nullable()->comment('Աշխատանքային առանձնահատկություններ - id');
            $table->unsignedTinyInteger('education_id')->nullable()->comment('Կրթություն - id');
            $table->unsignedTinyInteger('marital_status_id')->nullable()->comment('Ամուսնական կարգավիճակ - id');
            # END դաշտեր հսկիչ քարտի համար ստեղծված

            $table->string('workplace')->nullable()->default(NULL);
            $table->string('profession')->nullable()->default(NULL);

            $table->date('birth_date')->nullable()->default(NULL);
            $table->string('passport')->nullable()->default(NULL);
            $table->string('soc_card')->nullable()->default(NULL);
            $table->string('nationality')->nullable()->default(NULL);
            $table->boolean('is_male')->nullable()->default(NULL);
            // $table->string('sex')->nullable()->default(NULL);

            $table->string('m_phone')->nullable()->default(NULL);
            $table->string('c_phone')->nullable()->default(NULL);
            $table->string('email')->nullable()->default(NULL);

            $table->enum("blood_group", [1, 2, 3, 4])->nullable();
            $table->boolean("rh_factor")->nullable()->default(NULL);

            $table->foreign('living_place_id')->references('id')->on('living_place_lists');
            $table->foreign('social_living_condition_id')->references('id')->on('social_living_condition_lists');
            $table->foreign('working_feature_id')->references('id')->on('working_feature_lists');
            $table->foreign('education_id')->references('id')->on('education_lists');
            $table->foreign('marital_status_id')->references('id')->on('marital_status_lists');

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
        Schema::dropIfExists('patients');
    }
}
