<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('աշխատողի ID');
            $table->unsignedSmallInteger('department_id')->comment('բաժնի id, որը հասանելի է տվյալ աշխատողին');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('department_connections');
    }
}
