<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
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

            $table->boolean('shipped')->default(false);


            $table->unsignedBigInteger('correspondentAccount_id')->comment('Թղթակցող հաշիվ')->nullable();
            $table->foreign('correspondentAccount_id')->references('id')->on('correspondentaccount')
                ->onUpdate('cascade')->onDelete('set null');

            $table->integer('price')->comment('Գումարը թվերով')->nullable();
            $table->string('sum_text')->comment('Գումարը տառերով')->nullable();
            $table->string('social_card')->comment('Սող․ քարտ')->nullable();
            $table->string('document_type')->comment('Անձը հաստատող թղթի անվանումը')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
