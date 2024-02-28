<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementTechnicalCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_technical_characteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('invitation_quota_number')->nullable()->comment('Հրավերով նախատեսված չափաբաժնի համարը');
            $table->text('procurement_plan_passcode')->nullable()->comment('Գնումների պլանով նախատեսված միջանցիկ ծածկագիրը ըստ ԳՄԱ դասկարգման (CPV)');
            $table->text('name_and_trademark')->nullable()->comment('Անվանումը և ապրանքային նշանը');
            $table->text('manufacturer_name_and_country')->nullable()->comment('Արտադրողի անվանումը և ծագման երկիրը');
            $table->text('technical_specifications')->nullable()->comment('Տեխնիկական բնութագիրը');
            $table->text('measurement_unit')->nullable()->comment('Չափման միավորը');
            $table->text('unit_price')->nullable()->comment('Միավոր գինը ՀՀ դրամ');
            $table->text('total_price')->nullable()->comment('Ընդհանուր գինը ՀՀ դրամ');
            $table->text('total_quantity')->nullable()->comment('Ընդհանուր քանակը');
            // ՄԱՏԱԿԱՐԱՐՈՒՄ
            $table->text('address')->nullable()->comment('Հասցե');
            $table->text('quantities')->nullable()->comment('Ենթակա քանակներ');
            $table->text('deadlines')->nullable()->comment('Ժամկետներ');
            $table->text('general')->nullable()->comment('Ընդհանուր');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('procurement_technical_characteristics');
    }
}
