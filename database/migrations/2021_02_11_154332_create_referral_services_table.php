<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referral_id');

            // $table->unsignedBigInteger('serviceable_id');
            // $table->string('serviceable_type');
            $table->morphs('serviceable');

            $table->string('payment_type')->comment("Արդյոք կա պետպատվեր, սոց․ ապահովագրություն, համավճար կամ վճարովի է");
            $table->text('comment')->nullable()->comment("Լրացուցիչ տեղեկություններ");
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
        Schema::dropIfExists('referral_services');
    }
}
