<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarmfulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harmfuls', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('regular_id');
            // $table->tinyInteger('parent_id')->nullable();
            $table->string('name', 170);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harmfuls');
    }
}
