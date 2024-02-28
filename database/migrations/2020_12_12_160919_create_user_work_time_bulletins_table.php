<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkTimeBulletinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work_time_bulletins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_work_time_bulletin_id')->comment('բաժնի աշխ․ժամանակի տեղեկագրի id');
            $table->json('worktime')->nullable()->comment('օրվա ծախսած աշխ․ժամանակը - json');
            $table->timestamps();

            $table->foreign('department_work_time_bulletin_id', 'user_dwtb_id')->references('id')->on('department_work_time_bulletins');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_work_time_bulletins');
    }
}
