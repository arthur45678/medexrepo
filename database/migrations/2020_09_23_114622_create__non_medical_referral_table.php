<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonMedicalReferralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NonMedicalReferrals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');


            $table->unsignedBigInteger("sender_id");
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger("receiver_id")->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('NonMedicalReferrals');
    }
}
