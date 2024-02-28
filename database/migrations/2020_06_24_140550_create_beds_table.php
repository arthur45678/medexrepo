<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->smallIncrements("id");

            $table->unsignedSmallInteger("number");
            $table->boolean("is_occupied")->default(FALSE);

            $table->unsignedSmallInteger("chamber_id");
            $table->foreign("chamber_id")->references("id")->on("chambers");

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
        Schema::dropIfExists('beds');
    }
}
