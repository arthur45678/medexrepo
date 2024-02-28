<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_accountings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('bandage_nurse_id');
            $table->unsignedBigInteger('chief_nurse_id');
            
            $table->date('date')->nullable()->comment('ամսաթիվ');
            $table->date('entry_date')->nullable()->comment('Մուտքի ամսաթիվ');
            
            $table->text('manipulation')->nullable()->comment('Մանիպուլացիա');
            $table->text('get_from')->nullable()->comment('Որտեղից է ստացել');
            $table->text('bandages')->nullable()->comment('Վիրակապական նըութեր');
            $table->text('bandag')->nullable()->comment('Վիրակապ');
            $table->text('tanzif')->nullable()->comment('Թանզիֆ');
            $table->text('alcohol')->nullable()->comment('Սպիրտ');
            $table->text('hydrogen_peroxide')->nullable()->comment('Ջրածնի պերոքսիդ');
            $table->text('povidonioditis')->nullable()->comment('Պովիդոնյոդիտ');
            $table->text('sodium_chloride')->nullable()->comment('Նատրիքլոր');
            $table->text('furacillin')->nullable()->comment('Ֆուռացիլին ');
            $table->text('adhesive_tape')->nullable()->comment('Կպչուն սպեղանի');
            $table->text('glove')->nullable()->comment('Ձեռնոց');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('bandage_nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('chief_nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            
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
        Schema::dropIfExists('inventory_accountings');
    }
}
