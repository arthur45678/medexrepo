<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderOutput', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('Բժիշկի ID')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('patient_id')->comment('Պոցիենտի ID')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('cashbox_id')->unsigned()->nullable();
            $table->foreign('cashbox_id')->references('id')->on('cashboxes')
                ->onUpdate('cascade')->onDelete('set null');

            $table->integer('price')->comment('Գումարը թվերով')->nullable();
            $table->string('sum_text')->comment('Գումարը տառերով')->nullable();
            $table->text('document_type')->comment('անձը հաստատող փաստաթղթի անվանումը')->nullable();
            $table->text('passport_data')->comment('համարը, ամսաթիվը և հանձման վայրը')->nullable();

            $table->string('social_card')->comment('ՀԾՀՀ')->nullable();

            $table->timestamps();
        });

        Schema::create('orderOutput_treatment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger("treatment_id")->nullable()->comment("Բուժման տեսակ");
            $table->foreign("treatment_id")->references("id")->on("treatment_lists");

            $table->string('social_card')->comment('ՀԾՀՀ')->nullable();
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
        Schema::dropIfExists('orderOutput');
    }
}
