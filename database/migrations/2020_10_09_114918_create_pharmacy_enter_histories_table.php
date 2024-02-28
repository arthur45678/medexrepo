<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyEnterHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_enter_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('department_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable()->comment('դեղի id-ն, (պահեստի հաշվարկի համար)');
            $table->integer('enter')->comment('Մուտ եկած դեղերի քանակը');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('pharmacy_enter_histories');
    }
}
