<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonmedicalreferralsServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonmedicalreferrals_service', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('referral_id');
            $table->unsignedMediumInteger('service_list_id');
            $table->string('payment_type')->comment("Արդյոք կա պետպատվեր, սոց․ ապահովագրություն, համավճար կամ վճարովի է");
            $table->text('comment')->nullable()->comment("Լրացուցիչ տեղեկություններ");


            $table->foreign('referral_id')->references('id')->on('nonmedicalreferrals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_list_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('nonmedicalreferrals_service');
    }
}
