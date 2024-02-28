<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referral_id');
            $table->unsignedMediumInteger('service_list_id');
            $table->string('payment_type')->comment("Արդյոք կա պետպատվեր, սոց․ ապահովագրություն, համավճար կամ վճարովի է");
            $table->text('comment')->nullable()->comment("Լրացուցիչ տեղեկություններ");
            $table->timestamps();

            $table->foreign('referral_id')->references('id')->on('referrals');//->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_list_id')->references('id')->on('service_lists');//->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_service');
    }
}
