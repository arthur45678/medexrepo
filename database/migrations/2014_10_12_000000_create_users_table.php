<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('department_id')->nullable();
            $table->string('department_code')->nullable();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('p_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('account_suspended')->default(FALSE)->comment("Users with suspended account CAN NOT log in, but are not deleted from DB");
            $table->text('residence_region')->nullable();
            $table->text('town_village')->nullable();
            $table->text('street_house')->nullable();

            $table->string('degree')->nullable();
            $table->string('position')->nullable();

            $table->date('birth_date')->nullable();
            $table->string('passport')->nullable();
            $table->string('soc_card')->nullable();
            $table->string('nationality')->nullable();
            // $table->string('sex')->nullable();
            $table->boolean("is_male")->nullable();

            $table->string('m_phone')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('background',['c-app  c-dark-theme','c-app'])->default('c-app');

            $table->rememberToken();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('cashbox_id')->unsigned()->nullable();
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
        Schema::dropIfExists('users');
    }
}
