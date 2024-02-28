<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleMedicinelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_medicinelists', function (Blueprint $table) {
            $table->id();
           // $table->morphs("medicinelistable");
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('user_id');

            $table->string("medicineLists_type")->comment("Ախտորոշման տեսակը");
            $table->unsignedBigInteger('medicinelists_id')->nullable()->default(NULL);

            $table->text('medicinelists_comment')->nullable()->default(NULL);
            $table->date('medicinelists_date')->nullable()->default(NULL);

            $table->string('drug_using_time')->comment('Օգտագործման ժամ')->nullable()->default(NULL);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('medicinelists_id')->references('id')->on('medicine_lists')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('sample_medicinelists');
    }
}
