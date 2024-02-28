<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvements', function (Blueprint $table) {
            $table->id();

            $table->morphs("approvable");

            $table->tinyInteger("status")->default(0);

            $table->unsignedSmallInteger("department_id")->comment("Գրառումը կատարած օգտատերի բաժին");
            $table->unsignedBigInteger("approved_by")->nullable()->default(NULL)->comment("Գրառումը հատատած օգտատեր");

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('approved_by')->references('id')->on('users');

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
        Schema::dropIfExists('approvements');
    }
}
