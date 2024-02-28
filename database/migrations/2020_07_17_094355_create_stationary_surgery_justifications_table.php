<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationarySurgeryJustificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_surgery_justifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("attending_doctor_id")->nullable()->default(NULL)->comment("Բուժող բժիշկ");
            $table->unsignedBigInteger("department_head_id")->nullable()->default(NULL)->comment("Բաժանմունքի վարիչ");
            $table->unsignedBigInteger("medical_affairs_deputy_director_id")->nullable()->default(NULL)->comment("Բուժական գծով փոխտնօրեն");
            $table->unsignedBigInteger("stationary_id");

            $table->text("justification")->nullable()->default(NULL)->comment("Հիմնավորում (վիրահատության)");
            $table->date("date")->nullable()->default(NULL);

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("attending_doctor_id")->references("id")->on("users");
            $table->foreign("department_head_id")->references("id")->on("users");
            $table->foreign("medical_affairs_deputy_director_id", "ma_deputy_director_id")->references("id")->on("users");
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
        Schema::dropIfExists('stationary_surgery_justifications');
    }
}
