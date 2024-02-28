<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambulator_id');
            $table->unsignedBigInteger('user_id');

            $table->date('health_status_date')->comment('Հիվանդի վիճակը/այցի ամսաթիվ');
            $table->text('health_status_text')->nullable()->comment('Հիվանդի վիճակը');
            $table->timestamps();

            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_statuses');
    }
}
