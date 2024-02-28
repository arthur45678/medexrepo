<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("patient_id");
            $table->foreign('patient_id')->references('id')->on('patients');//->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger("patient_connection_id")->nullable()->default(NULL);
            $table->foreign('patient_connection_id')->references('id')->on('patient_connections');//->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("sender_id");
            $table->foreign('sender_id')->references('id')->on('users');//->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger("receiver_id")->nullable();
            $table->foreign('receiver_id')->references('id')->on('users');//->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedSmallInteger("department_id");
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');

            $table->timestamp("opened_at")->nullable()->default(NULL)->comment("Արդյոք ստացողը բացել է ուղեգիրը");
            $table->timestamp("accepted_at")->nullable()->default(NULL)->comment("Արդյոք ստացողը ընդունել է ուղեգիրը");
            $table->timestamp("finished_at")->nullable()->default(NULL)->comment("Արդյոք ստացողը ավարտել է ուղեգիրում նշված գործը");

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
        Schema::dropIfExists('referrals');
    }
}
