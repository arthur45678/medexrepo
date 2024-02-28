<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_packages', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('pkey')->nullable()->comment('Ոչ մի դեր, արմենդից, զուտ հեգագալի համար կարող է պետք լինել');
            $table->text('name')->comment('սոց․ փաթեթի ավանում');
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
        Schema::dropIfExists('social_packages');
    }
}
