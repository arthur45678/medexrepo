<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTnmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tnms', function (Blueprint $table) {
            $table->id();
            $table->string("T")->nullable()->comment("TNM - ի T, in:0,1,2,3,4 each with a|b");
            $table->string("N")->nullable()->comment("TNM - ի N, in:0,1,2,3,x each with a|b");
            $table->string("M")->nullable()->comment("TNM - ի M, in:0,1,x each with a|b");

            $table->string("Grade")->nullable()->default(NULL)->comment("TNM - ի Grade, in:1,2,3,4,x");
            $table->string("L")->nullable()->default(NULL)->comment("TNM - ի L, in:0,1,x");
            $table->string("V")->nullable()->default(NULL)->comment("TNM - ի V, in:0,1,2,x");
            $table->string("pycmr")->nullable()->default(NULL)->comment("TNM - ի 'tumor classification', in:p,y,c,m,r");

            $table->unsignedBigInteger('user_id');
            $table->morphs("tnmable"); // = $table->string('tnmable_type') + $table->unsignedBigInteger('tnmable_id')
            $table->timestamps();

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
        Schema::dropIfExists('tnms');
    }
}
