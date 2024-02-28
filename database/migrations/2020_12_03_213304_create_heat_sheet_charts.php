<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeatSheetCharts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heat_sheet_charts', function (Blueprint $table) {
            $table->id();

            $table->string('day')->nullable()->comment('Ստացիոնար ընդունվելու օրը');
            $table->string('day_time_period')->nullable()->comment('Ժամանակահատվածը (առավետ/երեկո)');
            $table->string('A_CH_comment')->nullable()->comment('ԱՃ լրացման ազատ դաշտ․․․');


            $table->float('temperature')->nullable();
            $table->float('p')->nullable();
            $table->float('t_0')->nullable();


            $table->unsignedBigInteger('heat_sheet_id')->nullable();
            $table->foreign('heat_sheet_id')->references('id')->on('heat_sheets')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('heat_sheet_charts');
    }
}
