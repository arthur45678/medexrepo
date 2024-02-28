<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryResuscitationDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_resuscitation_departments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("stationary_id");

            $table->text("comment")->nullable()->default(NULL);
            $table->date("date")->nullable()->default(NULL);

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("stationary_id")->references("id")->on("stationaries");

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
        Schema::dropIfExists('stationary_resuscitation_departments');
    }
}
